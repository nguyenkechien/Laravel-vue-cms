<div class="filter">
  {{-- <span class="filter-item active">
    <a href="javascript:void(0)" data-filter="all" class="filter-item-content"> Tất cả </a>
  </span> --}}
  @foreach($category as $i=>$item)
    <span class="filter-item ">
    <a href="javascript:void(0)" data-filter="{{ $item->param }}" class="filter-item-content"> {{$item->name}} </a>
    </span>
  @endforeach
</div>
