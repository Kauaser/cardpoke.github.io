<div class="col-lg-4 col-md-6 col-sm-12" data-aos="fade-up" data-aos-delay="<?= $delay ?? 0 ?>">
    <div class="card card-hover">
        <img src="../<?= $parceiro['foto'] ?>" class="card-img-top" alt="<?= $parceiro['nome'] ?>">
        <div class="card-body text-center">
            <h5 class="card-title"><?= $parceiro['nome'] ?></h5>
            <p class="card-text">Compartilha dicas e estratégias de colecionismo.</p>
            <a href="<?= $parceiro['link'] ?>" class="btn btn-primary">Ver Perfil</a>
        </div>
    </div>
</div>