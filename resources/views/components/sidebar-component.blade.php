<!-- <div>
    An unexamined life is not worth living. - Socrates
</div> -->

<div class="accordion mt-4" id="accordionExample">
          @php $i=1; @endphp
          @foreach($categories as $category)
          <div class="card">
            <div class="card-header" id="headingOne">
              <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne{{$i}}" aria-expanded="true" aria-controls="collapseOne{{$i}}">
                <h6>   {{$category->name}} </h6>
                </button>
              </h2>
            </div>

            <div id="collapseOne{{$i}}" class="collapse @if($loop->first) {{'show'}} @endif" aria-labelledby="headingOne" data-parent="#accordionExample">
              <div class="card-body">
                @foreach($category->subcategories as $subcategory)
                <a class="btn btn-link btn-block" href="{{route('itemsbysubcategory',$subcategory->id)}}" data-id="{{$subcategory->id}}"><h5>{{$subcategory->name}}</h5></a>
                @endforeach
              </div>
            </div>
          </div>
          @php $i++; @endphp
          @endforeach
        </div>