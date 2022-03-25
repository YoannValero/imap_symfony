# Test imap symfony 5

## Uncomment .local extension and set .env environment variable

## Bundle secit-pl/imap-bundle

- Create **imap.yaml** file in config/packages/
```yaml
imap:
    connections:
        example_connection:
            mailbox: "{localhost:143}INBOX"
            username: "email@example.com"
            password: "password"
            # Optional
            # attachments_dir: "%kernel.root_dir%/../var/imap/attachments"
            server_encoding: "UTF-8"
```

```sh
composer install
```
