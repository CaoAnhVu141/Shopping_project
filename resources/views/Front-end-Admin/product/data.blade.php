<div class="box-body table-responsive no-padding">
    <table class="table table-hover">
        <tbody>
            <tr>
                <th>STT</th>
                <th>Name</th>
                <th>SL - còn</th>
                <th>Category</th>
                <th>Avatar</th>
                <th>Price</th>
                <th>Discount</th>
                <th>Status</th>
                <th>Times</th>
                <th>Action</th>
            </tr>

            @if (isset($products))
                @foreach ($products as $item)
                    @php
                        $i ++;
                    @endphp
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $item->name }}</td>
                        {{-- <td>{{ $item->amount }} - {{ ($item->pro_number-$item->pro_pay) }}</td> --}}
                        <td>{{ $item->amount }}</td>
                        {{-- <td>{{ $item->category->id_category }}</td> --}}
                        {{-- <td><span class="label label-warning">{{ $item->category->c_name ?? "[N\A]" }}</span></td> --}}
                        <td><img src="{{asset($item->image) }}" alt="" width="150px" height="100px"> </td>
                        <td>{{ $item->price }}</td>
                        <td>
                            @if ($item->discount)
                                <span class="label label-default"
                                    style="text-decoration: line-through;">{{ number_format($item->price, 0, ',', '.') }}
                                    VND</span><br>
                                @php
                                    $price = $item->price * (1 - $item->discount / 100);
                                @endphp
                                <span class="label label-success">{{ number_format($price, 0, ',', '.') }} VND</span><br>
                                <span>Giảm {{ $item->discount }}%</span>
                            @else
                                <span class="label label-success">{{ number_format($item->price, 0, ',', '.') }}
                                    VND</span>
                            @endif
                        </td>
                        <td>
                            @if ($item->checkactive == 1)
                            <a href="{{ route('toggleaproduct',['id'=>$item->id_product]) }}" class="label label-info status-active">Hot</a>
                            @else
                             <a href="{{ route('toggleaproduct',['id'=>$item->id_product]) }}" class="label label-default status-active">No</a>
                             @endif
                        </td>
                        
                        <td>{{ $item->created_at }}</td>
                        <td>
                            <a href="{{ route('editproduct', ['id' => $item->id_product]) }}"
                                class="btn btn-xs btn-primary" onclick="return confirm('Bạn có Sửa không nè')"><i
                                    class="fa fa-pencil"></i> Edit</a>
                            <a href="{{ route('deleteproducts', ['id' => $item->id_product]) }}"
                                class="btn btn-xs btn-danger js-delete-confirm"
                                onclick="return confirm('Bạn có chắc xoá không nè')"><i class="fa fa-trash"></i>
                                Delete</a>
                        </td>
                    </tr>                                                          
                @endforeach              
            @endif
        </tbody>
        
    </table>
     <div id="pageNavPosition" class="text-right">
        {{-- <ul class="pagination">
            <!-- Hiển thị link đến trang trước (Previous Page) -->
            @if ($products->onFirstPage())
                <li class="disabled"><span>&laquo;</span></li>
            @else
                <li><a href="{{ $products->previousPageUrl() }}" rel="prev">&laquo;</a></li>
            @endif
    
            <!-- Hiển thị các số trang đã có -->
            @for ($i = 1; $i <= $products->lastPage(); $i++)
                <li class="{{ $i == $products->currentPage() ? 'active' : '' }}">
                    <a href="{{ $products->url($i) }}">{{ $i }}</a>
                </li>
            @endfor
            <!-- Hiển thị link đến trang tiếp theo (Next Page) -->
            @if ($products->hasMorePages())
                <li><a href="{{ $products->nextPageUrl() }}" rel="next">&raquo;</a></li>
            @else
                <li class="disabled"><span>&raquo;</span></li>
            @endif
        </ul> --}}
        {{-- @comment --}}
    {{-- {{ $products->links() }} --}}

    </div> 
</div>
