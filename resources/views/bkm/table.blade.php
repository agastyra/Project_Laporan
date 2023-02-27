<<<<<<< HEAD
 @forelse ($bkm as $item)
 <tr>
     <td>{{ $item->no_bkm }}</td>
     <td>{{ $item->transaksi_penjualan->no_transaction }}</td>
     <td>{{ $item->tanggal }}</td>
     <td>{{ $item->description }}</td>
     <td>Rp. {{ number_format($item->total, 0, ',', '.') }}</td>
     <td><a href="{{ route('bkm.edit', $item->id) }}" class="btn btn-primary"><i
                 class="mdi mdi-arrow-right-circle-outline icon-sm"></i></a>
         <a href="{{route('print', $item->id)}}" class="btn btn-warning"> <i class="mdi mdi-printer"></i></a>
     </td>

 </tr>
 @empty
 <tr>
     <td colspan="5" class="text-center">Belum ada Kas Masuk Bulan ini</td>
 </tr>
 @endforelse
=======
@forelse ($bkm as $item)
<tr>
    <td>{{ $item->no_bkm }}</td>
    @if ($item->transaksi_penjualan_id == 0)
    <td>{{ $item->jurnal_memorial->transaction_no }}</td>
    @else
    <td>{{ $item->transaksi_penjualan->no_transaction }}</td>
    @endif
    <td>{{ $item->tanggal }}</td>
    <td>{{ $item->description }}</td>
    <td>Rp. {{ number_format($item->total, 0, ',', '.') }}</td>
    <td><a href="{{ route('bkm.edit', $item->id) }}" class="btn btn-primary"><i class="mdi mdi-arrow-right-circle-outline icon-sm"></i></a>
    </td>
</tr>
@empty
<tr>
    <td colspan="6" class="text-center">Belum ada Kas Masuk Bulan ini</td>
</tr>
@endforelse
>>>>>>> c38c00b178306f601efbd6a0295f48fbfb14a12a
