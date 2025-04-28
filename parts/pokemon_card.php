<div class="col-lg-3 col-md-6 col-sm-12">
  <div class="card card-hover">
    <img src="<?= $item['foto'] ?>" alt="<?= $item['nome'] ?>" class="img-fluid">
    <div class="card-body text-center">
      <h5 class="card-title"><?= $item['nome'] ?></h5>
      <p class="card-text">R$ <?= number_format($item['preco'], 2, ',', '.') ?></p>
      <button class="btn btn-primary btn-sm" onclick="addToCart('card<?= $item['id'] ?>', '<?= $item['nome'] ?>', <?= $item['preco'] ?>)">
        Adicionar ao Carrinho
      </button>
    </div>
  </div>
</div>
