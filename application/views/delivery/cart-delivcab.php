<tr class="row-cart" align="center">
  <td class="text-uppercase reccu">
    <?= $this->input->post('reccu') ?> - <?= $this->input->post('kdpaket') ?>
    <input type="hidden" name="reccu_hidden[]" value="<?= $this->input->post('reccu') ?>">
  </td>

  <?= $this->input->post('idpaket') ?>
  <input type="hidden" name="idpaket_hidden[]" value="<?= $this->input->post('idpaket') ?>">

  <?= $this->input->post('status') ?>
  <input type="hidden" name="status_hidden[]" value="<?= $this->input->post('status') ?>">

  <td>
    <button type="button" class="btn btn-danger" id="btn-hapus-reccu" data-toggle="tooltip" title="Hapus Reccu" data-reccu="<?= $this->input->post('reccu') ?>">
      <i class="fas fa-times"></i>
    </button>
  </td>
</tr>