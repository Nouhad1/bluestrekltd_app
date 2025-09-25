<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.css')

    <style type="text/css">
      .div_center {
          text-align: center;
          padding-top: 40px;
      }

      .h2_font {
          font-size: 40px;
          padding-bottom: 40px;
      }

      .th_color {
          background: #2225d3;
      }

      .center {
          margin: auto;
          width: 50%;
          text-align: center;
          margin-top: 30px;
          border: 1px solid #2225d3;
      }

      td {
          border: 2px solid #2225d3;
      }
    </style>
  </head>
  <body>
    <div class="container-scroller">
        @include('admin.sidebar')
        @include('admin.header')

        <div class="main-panel">
            <div class="content-wrapper">

                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif

                <h2>Catégories</h2>

<!-- Formulaire d’ajout -->
<form action="{{ route('admin.categories.add') }}" method="POST" class="mb-3">
    @csrf
    <input type="text" name="category" placeholder="Nouvelle catégorie" required>
    <button type="submit" class="btn btn-primary">Ajouter</button>
</form>

<!-- Liste des catégories -->
<table class="table table-bordered mt-4">
    <tr class="th_color">
        <th>Nom catégorie</th>
        <th>Action</th>
    </tr>
    @foreach($categories as $category)
        <tr>
            <td>{{ $category->catagory_name }}</td>
            <td>
                <a href="{{ route('admin.categories.delete', $category->id) }}"
                   onclick="return confirm('Are you sure to delete this category ?')"
                   class="btn btn-danger btn-sm">Supprimer</a>
            </td>
        </tr>
    @endforeach
</table>


            </div>
        </div>
    </div>
    @include('admin.script')
  </body>
</html>
