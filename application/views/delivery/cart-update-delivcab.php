<tr class="tbdetail">
  <td class="text-uppercase">
    <?= $this->input->post('reccu') ?> - <?= $this->input->post('kdpaket') ?>
    <input type="hidden" name="reccu_hidden[]" value="<?= $this->input->post('reccu') ?>" readonly>
  </td>

  <?= $this->input->post('idpaket') ?>
  <input type="hidden" name="idpaket_hidden[]" value="<?= $this->input->post('idpaket') ?>">

  <td class="text-capitalize">
    <?= $this->input->post('status') ?>
    <input type="hidden" name="status_hidden[]" value="<?= $this->input->post('status') ?>">
  </td>

  <td>
    <button type="button" class="btn btn-danger" id="btn-hapus-reccu" data-toggle=" tooltip" title="Hapus Reccu" data-reccu="<?= $this->input->post('reccu') ?>">
      <i class="fas fa-times"></i>
    </button>
  </td>
</tr>