            <?php if(is_object($this->form)) { ?>
            <section class="jumbo">
                <a href="/admin">
                    <i class="icon ion-ios-arrow-round-back"></i>
                    <?php if ($this->form->name) {
                        echo $this->escape($this->form->name);
                    } else { ?>
                        <span class="font-italic">Untitled</span>
                    <?php } ?>
                </a>
            </section>

            <section class="edit-meta">
                <form class="card">
                    <div class="form-group input-material">
                        <input type="text" class="form-control" id="name-field" name="name" required value="<?= $this->escape($this->form->name); ?>">
                        <label for="name-field">Form Name</label>
                    </div>
                    <div class="form-group input-material">
                        <input type="text" class="form-control" id="whitelist-field" name="whitelist" required value="<?= $this->escape($this->form->whitelist); ?>">
                        <label for="whitelist-field">Domain whitelist</label>
                    </div>
                </form>
            </section>

            <section class="edit-meta">
                <form class="card">
                    <div class="form-group input-material group-disabled">
                        <input type="text" class="form-control" id="name-field" name="name" readonly value="<?= $this->escape($this->form->public_id); ?>">
                        <label for="name-field">Public ID</label>
                    </div>
                    <div class="form-group input-material group-disabled">
                        <input type="text" class="form-control" id="whitelist-field" name="whitelist" readonly value="<?= $this->escape(redirect::getSiteURL().'/form/'.$this->form->public_id); ?>">
                        <label for="whitelist-field">Submit URL</label>
                    </div>
                </form>
            </section>

            <section class="edit-code">
                <div class="card code-card">
                    <h3><i class="icon ion-ios-checkbox"></i> Validation Rules</h3>
                    <i class="icon ion-ios-information-circle-outline icon-md icon-btn example-btn" data-toggle="collapse" data-target="#validation-example-collapse" data-placement="left" title="View Example"></i>
                    <div id="validation-example-collapse" class="example-code collapse">
<pre>
{
   "name": "required|min:2|max:200",
   "company": "max:200",
   "email": "required|email",
   "message": "required|min:10|max:50000"
}</pre>
                    </div>
                    <pre id="editor-rules" class="editor">
<?= $this->form->validation_rules; ?></pre>
                </div>
            </section>

            <section class="edit-code">
                <div class="card code-card">
                    <h3><i class="icon ion-ios-notifications"></i> Notification Settings</h3>
                    <i class="icon ion-ios-information-circle-outline icon-md icon-btn example-btn" data-toggle="collapse" data-target="#notifiers-example-collapse" data-placement="left" title="View Example"></i>
                    <div id="notifiers-example-collapse" class="example-code collapse">
<pre>
{
    "email": {
        "smtp": {
            "host": "smtp.example.com",
            "port": "465",
            "username": "example",
            "password": "",
            "from_address": "noreply@example.com",
            "from_name": "Form Endpoint"
        },
        "to": {
            "address": "admin@example.com",
            "name": "Admin"
        },
        "replyTo": {
            "address_field": "email",
            "name_field": "name"
        }
    }
}</pre>
                    </div>
                    <pre id="editor-notify" class="editor">
<?= $this->form->notifiers; ?></pre>
                </div>
            </section>

            <section class="edit-meta">
                <div class="card">
                    <button type="button" class="btn btn-outline-danger icon-padding" data-toggle="collapse" data-target="#delete-form-collapse">
                        <i class="icon ion-ios-nuclear icon-md"></i> Delete Permanently
                    </button>
                    <div id="delete-form-collapse" class="collapse">
                        <div class="alert alert-danger mt-3" role="alert">
                            Are you sure you want to delete this form? This action cannot be undone!
                            <form class="delete-button" action="/admin/form/<?= $this->escape($this->form->public_id); ?>" method="POST">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="submit" class="btn btn-outline-danger icon-padding ml-5" value="Yes, delete forever">
                            </form>
                        </div>
                    </div>
                </div>
            </section>

            <?php } else { // if not object ?>
                <div class="jumbotron text-center mt-5">
                    <h3><?= $this->escape($this->form); ?></h3>
                </div>
            <?php } ?>