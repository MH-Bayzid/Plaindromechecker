# Palindrome Checker — CMS Task 2

A small custom module for Drupal 11. It adds a form at `/palindrome` and a help page at `/admin/help/palindrome_checker`.

## What it does

Enter a word or phrase and press **Check**. The form removes spaces and punctuation, converts letters to lowercase, and compares the text with its reverse. Numbers count too. Empty input and input containing only symbols are rejected. The text is not stored.

Examples:

| Input | Result |
| --- | --- |
| level | Palindrome |
| Drupal | Not a palindrome |
| A man, a plan, a canal: Panama! | Palindrome |
| 12321 | Palindrome |

**Current machine status:** module tests passed locally. Lando prerequisites are installed, but Windows requires a restart before Lando can be tested. See `LANDO-STATUS.md`.

## Start with Lando

Install [Lando](https://docs.lando.dev/install/windows.html) and its Docker prerequisites first. Docker must be running with Linux containers. On Windows, finish any requested WSL setup and restart before starting the project.

From this project folder:

```sh
lando start
lando composer install
lando drush site:install standard --db-url=mysql://drupal11:drupal11@database/drupal11 --site-name="Palindrome Checker" --account-name=admin -y
lando drush en palindrome_checker -y
lando drush config:set system.site page.front /palindrome -y
lando drush cr
```

Run `site:install` only for the first installation: it replaces the database selected by the command. Save the administrator password printed by Drush, or use `lando drush uli` to obtain a one-time login link.

Open the address shown by `lando info`, normally `http://palindrome-task2.lndo.site/palindrome`. Use `lando stop` when finished. Later, only `lando start` is needed.

The Lando configuration uses Drupal 11, PHP 8.4, MariaDB 10.11 and the `web` document root. The project has its own dependencies and database; it does not use the Task 1 site.

## Module files

The module is in `web/modules/custom/palindrome_checker`.

- `palindrome_checker.info.yml`: module name, compatibility and Help dependency.
- `palindrome_checker.routing.yml`: connects `/palindrome` to the form.
- `palindrome_checker.links.menu.yml`: adds the main menu link.
- `src/Form/PalindromeForm.php`: builds the form, validates input and checks the result.
- `palindrome_checker.module`: implements `palindrome_checker_help()`, Drupal's `hook_help()`.

The form uses Drupal's Form API and translation placeholders to display entered text safely. Unicode-aware splitting keeps accented letters intact. The core Olivero theme supplies the appearance; no custom theme or JavaScript is needed.

## Screenshots and checks

Screenshots are saved in `screenshots/`. See `TEST-RESULTS.md` for actual test outcomes and `LANDO-STATUS.md` for the Lando environment status. Screenshot filenames describe each case, including success, failure, validation and module help.

## Submit to GitHub

Create an empty GitHub repository, then run these commands in this folder. Replace YOUR-USERNAME and REPOSITORY with your own values.

```sh
git add .
git status --short
git commit -m "Add Drupal palindrome checker module"
git remote add origin https://github.com/YOUR-USERNAME/REPOSITORY.git
git push -u origin main
```

The `.gitignore` excludes downloaded Drupal core, dependencies, generated settings, credentials, logs and local databases. The source, Composer lock file, Lando configuration, documentation and screenshots are included. Submit the repository URL and attach the screenshots required by the assignment. No GitHub repository has been published by this setup.

## References

- [Creating Drupal modules](https://www.drupal.org/docs/develop/creating-modules)
- [Introduction to Form API](https://www.drupal.org/docs/drupal-apis/form-api/introduction-to-form-api)
- [hook_help()](https://api.drupal.org/api/drupal/core%21modules%21help%21help.api.php/function/hook_help/11.x), also checked in Drupal core's `help.api.php`.
- [Lando Drupal recipe](https://docs.lando.dev/plugins/drupal/config.html)

## Screenshot preview

![Palindrome result](screenshots/02-palindrome.png)

![Module help](screenshots/07-module-help.png)

