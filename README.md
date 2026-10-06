# Palindrome Checker

A simple Drupal 11 module for CMS Task 2. It checks whether a word or phrase reads the same forwards and backwards.

The checker ignores case, spaces and punctuation. It accepts letters and numbers, including accented letters, and rejects empty or symbols-only input.

- `level` → palindrome
- `Drupal` → not a palindrome
- `A man, a plan, a canal: Panama!` → palindrome

## Run with Lando

Start Docker Desktop, then run these commands from the project folder:

```sh
lando start
lando composer install
```

For a new installation only:

```sh
lando drush site:install standard --db-url=mysql://drupal11:drupal11@database/drupal11 --site-name="Palindrome Checker" --account-name=admin -y
lando drush en palindrome_checker -y
lando drush config:set system.site page.front /palindrome -y
lando drush cr
```

`site:install` replaces the selected database, so do not run it again on an installed site. Use `lando drush uli` to log in as administrator.

Open http://palindrome-task2.lndo.site/palindrome. Use `lando stop` to stop the project and `lando start` to run it again.

## Module

The code is in `web/modules/custom/palindrome_checker`:

- `palindrome_checker.info.yml` defines the module.
- `palindrome_checker.routing.yml` adds the `/palindrome` page.
- `palindrome_checker.links.menu.yml` adds a menu link.
- `src/Form/PalindromeForm.php` handles the form, validation and result.
- `palindrome_checker.module` provides `hook_help()` at `/admin/help/palindrome_checker`.

The form uses Drupal's Form API. No custom JavaScript or theme is needed.

## References

- [Drupal module development](https://www.drupal.org/docs/develop/creating-modules)
- [Form API](https://www.drupal.org/docs/drupal-apis/form-api/introduction-to-form-api)
- [hook_help()](https://api.drupal.org/api/drupal/core%21modules%21help%21help.api.php/function/hook_help/11.x)
