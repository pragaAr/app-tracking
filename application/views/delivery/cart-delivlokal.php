<tr class="row-cart" align="center">
  <td class="text-uppercase reccu">
    <?= $this->input->post('reccu') ?> - <?= $this->input->post('kdpaket') ?>
    <input type="hidden" name="reccu_hidden[]" value="<?= $this->input->post('reccu') ?>">
  </td>

  <?= $this->input->post('status') ?>
  <input type="hidden" name="status_hidden[]" value="<?= $this->input->post('status') ?>">

  <td class="action">
    <button type="button" class="btn btn-danger" id="tombol-hapus" data-toggle="tooltip" title="Delete" data-reccu="<?= $this->input->post('reccu') ?>">
      <i class="fas fa-times"></i>
    </button>
  </td>
</tr>