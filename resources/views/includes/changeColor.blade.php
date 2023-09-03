<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
@include('includes.header')
<div class="mt-3 mb-4">
    <div class="col-md-4">
        <div class="card" style="width: 18rem;">
            <div class="card-header">
              Choose the color
            </div>
            <ul class="list-group list-group-flush">
              <button type="button" class="btn btn-primary">Главный</button>
              <button type="button" class="btn btn-secondary">Вторичный</button>
              <button type="button" class="btn btn-success">Успех</button>
              <button type="button" class="btn btn-danger">Опасность</button>
              <button type="button" class="btn btn-warning">Предупреждение</button>
              <button type="button" class="btn btn-info">Инфо</button>
              <button type="button" class="btn btn-light">Светлый</button>
              <button type="button" class="btn btn-dark">Темный</button>
            </ul>
          </div>
    </div>
</div>
  <script src="{{ asset('js/script.js') }}"></script>
@include("includes.footer")