            <section class="listings" data-var="form-index">
                <?php
                if (is_array($this->forms)) {
                    foreach ($this->forms as $key => $form) {
                ?>
                <div class="card">
                    <div class="details">
                        <div class="small-title"><?= $this->escape($form->name); ?></div>
                        <div class="text-muted form-id"><?= $this->escape($form->public_id); ?></div>
                    </div>
                    <div class="buttons">
                        <a href="/admin/form/<?= $this->escape($form->public_id); ?>" class="icon-btn" data-toggle="tooltip" data-placement="left" title="Edit Form">
                            <i class="icon ion-md-create"></i>
                        </a>
                    </div>
                </div>
                <?php
                    } // end foreach
                } else { ?>
                    <div class="text-muted text-center font-italic mb-5 small"><?= $this->escape($this->forms); ?></div>
                <?php } ?>
            </section>

            <section class="create-section">
                <button type="button" class="btn btn-primary icon-padding"><i class="icon ion-ios-add-circle-outline icon-md"></i> New Form</button>
                <form class="card">
                    <div class="form-group input-material">
                        <input type="text" class="form-control" id="label-field" name="label" required>
                        <label for="label-field">Form Label</label>
                    </div>
                    <button type="submit" class="btn btn-primary icon-padding"><i
                            class="icon ion-ios-checkmark-circle-outline icon-md"></i> Create Form</button>
                </form>
            </section>