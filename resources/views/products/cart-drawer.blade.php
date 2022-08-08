@foreach ($items as $item)
    @php
        $product = $item->model;
    @endphp
    <div class="row border-bottom pb-2 mb-3" id="item{{ $item->rowId }}">
        <div class="col-4">
            <img src="{{ $product->uploads->getImageOptimizedFullName(200) }}" alt="" class="product-thumbnail border w-100">
        </div>
        <div class="col-8">
            <div class="cart-draw-item mb-2">
                <div class="product-title">{{ $product->name }}</div>
            </div>
            <div class="cart-draw-item mb-2">
                <a href="javascript:;" data-row-id="{{ $item->rowId }}" class="text-danger remove-item-btn " title="Remove from chart">Remove</a>
            </div>
            <div class="d-flex justify-content-between align-items-baseline">
                <input type="number" class="product-quantity p-1" value="{{ $item->qty }}" data-row-id="{{ $item->rowId }}" style="width: 60px;">
                <span class="product-price d-none">${{ $product->price / 100 }}</span>
                <span class="total-price">${{ $item->qty * $product->price / 100 }}</span>
            </div>
        </div>
    </div>
@endforeach
<div class="row">
  <div class="col-md-12">
    <a class="view-cart" href="{{ url('/cart') }}">View Cart</a>
  </div>
  <div class="col-md-12">
    <a class="checkout" href="{{ url('/checkout') }}">Checkout</a>
  </div>
</div>


<script>
    $(function() {
        $('.remove-item-btn').click(function() {
            var rowId = $(this).attr('data-row-id');

            $.ajax({
                url: "{{ url('cart') }}" + "/" + rowId,
                method: 'delete',
                data: {
                  _token: "{{ csrf_token() }}"
                },
                success: function(data) {
                  if (data) {
                    $(`#item${rowId}`).fadeOut();

                    var count = $('.cart-count').find('span').text() * 1 - 1;

                    if (count == 0) {
                      $('.cart-count').find('span').remove();
                    } else {
                      $('.cart-count').find('span').text(count);
                    }
                  }
                }
            });

        })

        $('.product-quantity').change(function() {
          var _this = this;
        var price = $(this).next().text().split('$')[1];
        var quantity = $(this).val();

        var total = price * quantity

        var rowId = $(this).attr('data-row-id');

        $.ajax({
            method: 'post',
            url: "{{ route('cart.edit.qty') }}",
            data: {
              _token: "{{ csrf_token() }}",
                row_id: rowId,
                quantity: quantity
            },
            success: function(data) {
              $(_this).next().next().text('$' + (Math.round(total * 100) / 100).toFixed(2));
            }
        })

    })

    })
</script>
