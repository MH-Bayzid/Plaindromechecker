# Test results

Tested on 5 October 2026 using Drupal 11.4.8, PHP 8.4.26, SQLite and Chrome.

These screenshots and tests use the local PHP server, not Lando. Lando verification is recorded separately.

- PASS: Anonymous visitors can open the checker.
- PASS: "level" produces the correct result.
- PASS: "Drupal" produces the correct result.
- PASS: "A man, a plan, a canal: Panama!" produces the correct result.
- PASS: "RaceCar" produces the correct result.
- PASS: "12321" produces the correct result.
- PASS: "12345" produces the correct result.
- PASS: "Äbä" produces the correct result.
- PASS: "été" produces the correct result.
- PASS: "a" produces the correct result.
- PASS: "<script>alert(1)</script>" produces the correct result.
- PASS: Symbols-only input is rejected.
- PASS: Empty input is rejected by server-side validation.
- PASS: A second submission updates the previous result.
- PASS: Mobile form fits the viewport.
- PASS: hook_help() renders the module help page.
- PASS: Module is enabled on the Extend page.
- PASS: No browser JavaScript errors.

- PASS: PHP syntax checks, Composer validation and platform requirements.
- PENDING: Lando container and MariaDB tests after the required Windows restart.
