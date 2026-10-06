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
