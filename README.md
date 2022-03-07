```sh
composer install
```

Edit config/packages/imap.yaml
```yaml
imap:
    connections:
        example_connection:
            mailbox: "{localhost:143}INBOX"
            username: "email@example.com"
            password: "password"
            attachments_dir: "%kernel.root_dir%/../var/imap/attachments"
            server_encoding: "UTF-8"
```
