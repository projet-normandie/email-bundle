ProjetNormandieEmailBundle
===========================

Develop
-------

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/projet-normandie/email-bundle/badges/quality-score.png?b=develop)](https://scrutinizer-ci.com/g/projet-normandie/email-bundle/?branch=develop)
[![Build Status](https://scrutinizer-ci.com/g/projet-normandie/email-bundle/badges/build.png?b=develop)]()


Installation
============

Make sure Composer is installed globally, as explained in the
[installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

Applications that use Symfony Flex
----------------------------------

Open a command console, enter your project directory and execute:

```console
$ composer require projet-normandie/article-bundle
```

Applications that don't use Symfony Flex
----------------------------------------

### Step 1: Download the Bundle

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```console
$ composer require projet-normandie/article-bundle
```

### Step 2: Enable the Bundle

Then, enable the bundle by adding it to the list of registered bundles
in the `config/bundles.php` file of your project:

```php
// config/bundles.php

return [
    // ...
    ProjetNormandie\ArticleBundle\ProjetNormandieArticleBundle::class => ['all' => true],
];
```

Configuration
============

### Database

In order to link your User entity to this module you should add the following configuration:
(Replace AppBundle\Entity\User with your user class).

[Official documentation](http://symfony.com/doc/current/cookbook/doctrine/resolve_target_entity.html)

```yaml
# Doctrine Configuration - config.yml
doctrine:
    orm:
        resolve_target_entities:
            ProjetNormandie\EmailBundle\Entity\UserInterface: AppBundle\Entity\User
```

After resolving the entity you can update your database schema.


### Module Configuration

The from has to be set globally.

```yaml
projet_normandie_email:
    from: "no-reply@projetnormandie.com"
    to: "contact@projetnormandie.com"
```

Note that the from can be overwritten when constructing the mail.

### Module Usage

Example of usage:

```php
use ProjetNormandie\EmailBundle\Entity\Email;
use ProjetNormandie\EmailBundle\Service\Mailer;

    private $mailer;
  
    /**
     * @param Mailer $mailer
     */
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }
   
    public function sendEemail()
    {
        $mail = new Email();
        $mail
            ->setTargetMail($email)
            ->setSubject($subject)
            ->setBodyHtml($body)
            ->setBodyText($body);

        $this->mailer->send($mail);
    }
```
