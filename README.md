# Test de connexion imap avec symfony 5

```sh
composer install
```

## Bundle secit-pl/imap-bundle

- Edit config/packages/imap.yaml
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
