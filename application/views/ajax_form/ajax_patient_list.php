<?php foreach ($pateintData as $key => $value) : ?>

<div class="row ticket-card mt-3 pb-2 border-bottom pb-3 mb-3">
  <div class="col-md-1">
    <img class="img-sm rounded-circle mb-4 mb-md-0" src="<?=base_url('images/faces/face1.jpg')?>" alt="profile image">
  </div>
  <div class="ticket-details col-md-9">
    <div class="d-flex">
      <p class="text-dark font-weight-semibold mr-2 mb-0 no-wrap"><?=$value->patient_name?></p>
    </div>
    <!-- <p class="text-gray ellipsis mb-2">Donec rutrum congue leo eget malesuada. Quisque velit nisi, pretium ut lacinia in, elementum id enim
      vivamus.
    </p> -->
    <div class="row text-gray d-md-flex d-none">
      <div class="col-4 d-flex">
        <small class="mb-0 mr-2 text-muted">Contact:</small>
        <small class="Last-responded mr-2 mb-0 text-muted"><?=$value->patient_contact?></small>
      </div>
      <div class="col-4 d-flex">
        <small class="mb-0 mr-2 text-muted">Email :</small>
        <small class="Last-responded mr-2 mb-0 text-muted"><?=$value->patient_email?></small>
      </div>
    </div>
  </div>
  <div class="ticket-actions col-md-2">
    <div class="btn-group dropdown">
      <button onclick="addSampleForm('<?=$value->patient_id?>' , this)" type="button" class="btn btn-success" >
        Select
      </button>
    </div>
  </div>
</div>

<?php endforeach; ?>
