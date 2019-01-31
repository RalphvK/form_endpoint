## How to register a new form

Register a new form by running the ```form``` command. This command will create a new form entry in the database with a randomly generated public ID. The command will return this ID in the output.

```bash
composer form
```

Optionally, the command accepts a JSON string as a parameter to define a set of validation rules for the ```rakit/validation``` library. However, since doing this will require you to escape all the quotes, the easiest way to add these rules will be to add them in the database after the form record has been created.

```bash
composer form "{\"name\": \"required|max:200\"}"
```

```rakit/validation``` documentation can be found [on Github](https://github.com/rakit/validation).

## Hooking up the form

Once your form is registered, you can send data by sending form data to the following route:

```xml
https://<your-domain>/form/<public_ID>
```

For example: ```https://example.com/form/SaGWK0muFVJG9RUkNpqMR3FMTB84BsHu```