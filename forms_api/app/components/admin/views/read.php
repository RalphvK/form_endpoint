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
                    <pre id="editor-rules" class="editor">
<?= $this->form->validation_rules; ?></pre>
                </div>
            </section>

            <section class="edit-code">
                <div class="card code-card">
                    <h3><i class="icon ion-ios-notifications"></i> Notification Settings</h3>
                    <pre id="editor-notify" class="editor">
<?= $this->form->notifiers; ?></pre>
                </div>
            </section>

            <?php } else { // if not object ?>
                <div class="jumbotron text-center mt-5">
                    <h3><?= $this->escape($this->form); ?></h3>
                </div>
            <?php } ?>