## Registering a new form

#### Create new form entry

Register a new form by running the ```form``` command. This command will create a new form entry in the database with a randomly generated public ID. The command will return this ID in the output.

```bash
composer form
```

Optionally, the command accepts a comma delimited string as a parameter which will server as the whitelist for allowed CORS origins. If no parameters is provided, you will have to set origins later when editing the database record.

```bash
composer form "https://example.com"
```

#### Set field validation rules

After the record has been created, add a json array containing validation rules in the ```validation_rules``` column field. This JSON string will be loaded as a PHP array via the ```json_decode()``` function and passed to the validation method. For example:

```json
{
   "name": "required|min:2|max:200",
   "company": "max:200",
   "email": "required|email",
   "message": "required|min:10|max:50000"
}
```

The fields are validated using the ```rakit/validation``` library. Its documentation can be found [on Github](https://github.com/rakit/validation).

#### CORS whitelist

You can set allowed cross-origins in the ```whitelist``` column. The syntax is a simple ```,``` or ```, ``` delimited string. For example:

```csv
https://example.com, https://cors.org
```

## Hooking up the form

Once your form is registered, you can send data by sending form data to the following route:

```xml
https://<your-domain>/form/<public_ID>
```

For example: ```https://example.com/form/SaGWK0muFVJG9RUkNpqMR3FMTB84BsHu```