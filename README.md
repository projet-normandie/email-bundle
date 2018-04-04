ProjetNormandieEmailBundle
=========================

Master
------

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/projet-normandie/EmailBundle/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/projet-normandie/EmailBundle/?branch=master)
[![Build Status](https://travis-ci.org/projet-normandie/EmailBundle.svg?branch=master)](https://travis-ci.org/projet-normandie/EmailBundle)

Develop
-------

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/projet-normandie/EmailBundle/badges/quality-score.png?b=develop)](https://scrutinizer-ci.com/g/projet-normandie/EmailBundle/?branch=develop)
[![Build Status](https://travis-ci.org/projet-normandie/EmailBundle.svg?branch=develop)](https://travis-ci.org/projet-normandie/EmailBundle)

Installation
============

Step 1: Download the Bundle
---------------------------

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```bash
$ composer require projet-normandie/email-bundle "~1"
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

Step 2: Enable the Bundle
-------------------------

Then, enable the bundle by adding it to the list of registered bundles
in the `app/AppKernel.php` file of your project:

```php
<?php
// app/AppKernel.php

// ...
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // ...

            new ProjetNormandie\EmailBundle\ProjetNormandieEmailBundle(),
        );

        // ...
    }

    // ...
}
```

Step 3: Configuration
---------------------

### Database

In order to link your User entity to this module you should add the following configuration:
(Replace ProjetNormandie\UserBundle\Entity\User with your user class).

[Official documentation](http://symfony.com/doc/current/cookbook/doctrine/resolve_target_entity.html)

```yaml
# Doctrine Configuration - config.yml
doctrine:
    orm:
        ...
        resolve_target_entities:
            ProjetNormandie\EmailBundle\Entity\UserInterface: AppBundle\Entity\User
```

After resolving the entity you can update your database schema.

### Routing

```yaml
projet_normandie_email:
    resource: "@ProjetNormandieEmailBundle/Controller/"
    type:     annotation
    prefix:   /{_locale}/email
    requirements:
        _locale: '%app_locales%'
    defaults:
        _locale: '%locale%'
```

### Module Configuration

The from has to be set globally.

```yaml
projet_normandie_email:
    from: "projetnormandie@projetnormandie.com"
```

Note that the from can be overwritten when constructing the mail.

### Module Usage

Example of usage (taken from [UserBundle](https://github.com/projet-normandie/UserBundle)):

```php
use ProjetNormandie\EmailBundle\Entity\Email;

$mailer = $this->get('projet_normandie_email.mailer');

$mail = new Email();
$mail
    //->setFrom('test@abc.com') // Here you override the global from
    ->setTarget($user)
    ->setTargetMail($user->getEmail())
    ->setSubject(
        $this->get('translator')->trans('subject.title.email-register', null, 'ProjetNormandieUserBundle')
    )
    ->setBodyHtml(
        $this->renderView(
            'ProjetNormandieUserBundle:registration/mail:email-register.html.twig',
            ['token' => $user->getToken()]
        )
    )
    ->setBodyText(
        $this->renderView(
            'ProjetNormandieUserBundle:registration/mail:email-register.txt.twig',
            ['token' => $user->getToken()]
        )
    );

$mailer->send($mail);

$em = $this->getDoctrine()->getManager();
$em->persist($user); // The user must be persisted before the mail (if it's a welcome mail).
$em->persist($mail);
$em->flush();
```
