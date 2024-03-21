@extends('layouts.app')

@section('title', 'Orders')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Orders</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Orders</a></div>
                    <div class="breadcrumb-item">Order Detail</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @include('layouts.alert')
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <div class="clearfix mb-3"></div>
                                <span style="display: block">Kasir : {{ $order->user->name }}</span>
                                <span style="display: block">Payment Method : {{ $order->payment_method }}</span>
                                <span style="display: block">Tanggal Order : {{ $order->transaction_time }}</span>
                                <span style="display: block">Jumlah Item : {{ $order->total_qty }}</span>
                                <span style="display: block">Total : @currency($order->total_price)</span>
                                <div class="table-responsive">
                                    <table class="table-striped table">
                                        <tr>
                                            <th>Image</th>
                                            <th>Nama</th>
                                            <th>Price</th>
                                            <th>Stock</th>
                                            <th>Dibuat Tanggal</th>
                                        </tr>
                                        @foreach ($orderItems as $item)
                                            <tr>
                                                <td>
                                                    @if ($item->product->image)
                                                        <img class="img-thumbnail"
                                                            src="{{ asset('storage/products/' . $item->product->image) }}"
                                                            alt="{{ $item->product->name }}" width="100px" />
                                                    @else
                                                        <span class="badge badge-danger">No Image</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $item->product->name }}
                                                </td>
                                                <td>
                                                    @currency($item->product->price)
                                                </td>
                                                <td>
                                                    {{ $item->product->stock }}
                                                </td>
                                                <td>
                                                    {{ $item->product->created_at }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                                <div class="float-right">
                                    {{ $orderItems->withQueryString()->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('library/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('js/page/features-posts.js') }}"></script>
    <script type="text/javascript">
        $('#confirm-button').click(function(event) {
            var form = $(this).closest("form");
            event.preventDefault();
            swal({
                    title: `Kamu yakin mau hapus produk ini?`,
                    text: 'Nanti produk itu akan hilang loh!',
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        });
    </script>
@endpush
