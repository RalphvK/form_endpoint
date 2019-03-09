<?php if (isset($this->navbarButton)) { ?>
    <form class="delete-button" action="<?= $this->escape($this->navbarButton->action); ?>" method="POST" onsubmit="<?= $this->escape($this->navbarButton->onsubmit); ?>">
        <input type="hidden" name="_method" value="<?= $this->escape($this->navbarButton->method); ?>">
        <button type="submit" class="btn <?= $this->escape($this->navbarButton->class); ?> icon-padding">
            <i class="icon <?= $this->escape($this->navbarButton->icon); ?> icon-md"></i> <?= $this->escape($this->navbarButton->text); ?>
        </button>
    </form>
<?php } ?>