<?php
$pageTitle = "Manage Records";
require_once "includes/header.php";
?>
<section class="hero"><div><span class="eyebrow">HOSPITAL ADMINISTRATION</span><h2>Manage your records</h2><p>Choose a section to add, view, edit or delete records stored in your database.</p></div><img src="https://images.unsplash.com/photo-1628009368231-7bb7cfcb0def?auto=format&fit=crop&w=1000&q=85" alt="Veterinarian examining a dog"></section>
<section class="grid">
<div class="card"><div class="card-body"><h3>Pet Owners</h3><p>Owner information and contacts.</p><a class="button" href="ownerinfo.php">Open Owners</a></div></div>
<div class="card"><div class="card-body"><h3>Pets</h3><p>Pet information and owner links.</p><a class="button" href="animalinfo.php">Open Pets</a></div></div>
<div class="card"><div class="card-body"><h3>Veterinarians</h3><p>Vet contact details and specialities.</p><a class="button" href="vetinfo.php">Open Vets</a></div></div>
<div class="card"><div class="card-body"><h3>Appointments</h3><p>Visits and appointment status.</p><a class="button" href="appointmentinfo.php">Open Appointments</a></div></div>
<div class="card"><div class="card-body"><h3>Treatments</h3><p>Medical care records.</p><a class="button" href="treatmentinfo.php">Open Treatments</a></div></div>
</section>
<?php require_once "includes/footer.php"; ?>
