<div class="row justify-content-center">
  <div class="col-md-7">
    <h1 class="text-center mb-4">Completed Todos</h1>
  </div>
</div>

<div class="row justify-content-center">
  <div class="col-md-7">
    <div class="card" style="background-color: #bada;">
      <div class="card-body">
        <form action="<?= BASEURL ?>/todos/create" method="post">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Add Todo..." name="kegiatan">
            <button class="btn btn-success" type="submit" name="submit">Add</button>
          </div>
        </form>
        <ul class="list-group mt-4">
          <?php $index = 1 ?>
          <?php foreach ($data['todos'] as $todo) : ?>
            <li class="list-group-item d-flex justify-content-between pt-3">
              <p>
                <?php if ($todo['status'] === 0) : ?> <i class="bi bi-x-lg ms-1"></i> <?php else : ?> <i class="bi bi-check-lg ms-1"></i> <?php endif ?> <?= $todo['kegiatan'] ?>
              </p>
              <div>
                <?php if ($todo['status'] === 0) : ?>
                  <a href="<?= BASEURL ?>/todos/updatestatus/<?= $todo['id'] ?>"><i class="bi bi-square me-2"></i></a>
                <?php else : ?>
                  <a href="<?= BASEURL ?>/todos/updatestatus/<?= $todo['id'] ?>"><i class="bi bi-check-square-fill me-2"></i></a>
                <?php endif ?>
                <a href="<?= BASEURL ?>/todos/destroy/<?= $todo['id'] ?>" onclick="return confirm('Hapus Todo?');"><i class="bi bi-trash3-fill"></i></a>
              </div>
            </li>
            <?php $index++ ?>
          <?php endforeach ?>
        </ul>
      </div>
    </div>
  </div>
</div>