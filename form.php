<main>
<form class="needs-validation m-5 p-5" method="post" action="">
  <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="validationTooltip01">First name</label>
      <input type="text" class="form-control" id="validationTooltip01" name="firstname" placeholder="First name">
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationTooltip02">Last name</label>
      <input type="text" class="form-control" id="validationTooltip02" placeholder="Last name">
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationTooltipEmail">email</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text" id="validationTooltipUsernamePrepend">@</span>
        </div>
        <input type="text" class="form-control" id="validationTooltipUsername" placeholder="email@gmail.com" aria-describedby="validationTooltipUsernamePrepend">
      </div>
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="validationTooltip03">Country</label>
      <input type="text" class="form-control" id="validationTooltip03" placeholder="Country">
    </div>
    <div class="col-md-3 mb-3">
    <label> Sex</label><br>
    <div class="form-check-inline">
        <label class="form-check-label">
            <input type="radio" class="form-check-input" name="sex" checked>M
        </label>
    </div>
    <div class="form-check-inline">
        <label class="form-check-label">
            <input type="radio" class="form-check-input" name="sex">F
        </label>
    </div>
    </div>
  </div>
  <div class="form-row">
      <div class="col-12 col-lg-6 col-sm-6">
        <label>subject</label>
        <select name="subject" id="subject">
          <option value="autre" selected>Autre</option>
          <option value="payement">Payement</option>
          <option value="delivery">Delivery</option>
          <option value="technical">Technical</option>
        </select>
      </div>
      <div class="col-12 col-lg-6 col-sm-6">
        <label>option</label>
        <select name="option" id="option">
          <option value="option" selected>Select option</option>
        </select>
      </div>
  </div>
  <div class="form-row">
      <div class="col-12 ">
          <textarea class="form-control" name="description" id="description" rows="10" placeholder="describe the problem"></textarea>
      </div>
  </div>
  <button class="btn btn-primary mt-3" type="submit" name="submit">Submit form</button>
</form>
</main>