$(document).ready(function () {
  let memberIdCounter = 1;

  $(".btn-add-family").click(function () {
    const cardHtml = `
          <div class="col-lg-4 col-md-6 mb-4 card">
              <div class="card-header">
                  <h5 class="card-title">Membre de la Famille</h5>
                  <button class="btn btn-remove-family" type="button">×</button>
              </div>
              <div class="card-body">
                  <div class="form-group">
                      <label class="card-label" for="name_${memberIdCounter}">Nom</label>
                      <input type="text" class="form-control" id="name_${memberIdCounter}" name="name[${memberIdCounter}]" placeholder="Nom">
                  </div>
                  <div class="form-group">
                      <label for="relationship_${memberIdCounter}">Relation</label>
                      <select class="form-select" id="relationship_${memberIdCounter}" name="relationship[${memberIdCounter}]">
                        <option value="conjoint">Conjoint</option>
                        <option value="fils">Fils</option>
                        <option value="fille">Fille</option>
                      </select>
                  </div>
                  <div class="form-group">
                      <label class="card-label" for="date_${memberIdCounter}">Date de naissance</label>
                      <input type="date" class="form-control" id="date_${memberIdCounter}" name="birthdate[${memberIdCounter}]">
                  </div>
                  <div class="form-group">
                      <label for="formFile_">Piéce justificative</label>
                      <input class="form-control" type="file" id="formFile_" name="formFile">
                    </div>
              </div>
          </div>
      `;

    $("#family-members").append(cardHtml);
    memberIdCounter++;
  });

  $(document).on("click", ".btn-remove-family", function () {
    const card = $(this).closest(".card");

    // Add fadeOut animation class before removing the card
    card.addClass("animate__fadeOut");

    // Delay removing the card to allow for the animation to complete
    setTimeout(function () {
      card.remove();
    }, 300); // Adjust the delay time if needed
  });
});
