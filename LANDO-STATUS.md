# Lando environment status

Checked on 5 October 2026.

- Lando 3.26.9 installed.
- Docker Desktop installed; Docker CLI reports 29.6.2.
- Docker Compose 2.40.3 and Buildx installed by Lando setup.
- WSL 3.0.1.0 installed successfully (installer exit code 0).
- Windows VirtualMachinePlatform enabled successfully.
- Windows returned exit code 3010: a restart is required.
- Lando setup could not complete its Docker network step before the restart.
- The Lando containers and MariaDB site are NOT yet verified.

## Continue after restarting Windows

1. Start Docker Desktop and wait until its engine is running.
2. Open a new PowerShell window and run:

```powershell
cd "D:\Business College\CMS-Task-2"
lando setup --plugin @lando/drupal --skip-install-ca --yes
lando start
```

3. Follow the first-install commands in README.md to install the separate Lando database, enable the module and set the front page.
4. Visit `/palindrome`, check `level` and `Drupal`, and visit `/admin/help/palindrome_checker` while logged in.

The completed browser tests and screenshots currently use the separate local PHP/SQLite verification site at http://127.0.0.1:8086/palindrome. That server stops on a computer restart. The Lando database is separate from that local test database. No claim of a successful Lando run is made yet.
