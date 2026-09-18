# InfinityFree Deployment

1. Run `powershell -ExecutionPolicy Bypass -File deployment/build-infinityfree.ps1`.
2. In the InfinityFree client area, open the account's FTP details.
3. Upload everything inside `dist/infinityfree/htdocs` into the domain's `htdocs` directory using FileZilla. Upload the folder contents, not the outer `htdocs` folder.
4. Open the account's phpMyAdmin and select the Science Bus database.
5. Import `dist/infinityfree/sciencebus.sql`.
6. Open the website and test `/`, `/gallery.php`, `/contactUs.php`, and `/admin/login.php`.
7. Confirm that `assets/uploads` is writable by uploading one small image from the admin panel.

The production database connection is selected automatically for non-localhost domains. Do not upload `debug.php`, `sql.php`, raw SQL files, `.git`, `deployment`, or `dist` into the public website directory.

After the first successful login, replace the default admin passwords and rotate the InfinityFree database password because deployment credentials have previously existed in the local source tree.
