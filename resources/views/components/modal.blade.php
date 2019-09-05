<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">
            Ecrire un commentaire
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('post.comment') }}">
            <textarea name="content" class="control-form" cols="30" rows="10"></textarea>
            <button type="submit" class="btn btn-secondary" data-dismiss="modal">
                Publier ce commentaire
            </button>
        </form>
      </div>
    </div>
  </div>
</div>