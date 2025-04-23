<?php
/*
PETUNJUK PERBAIKAN FILE settings.blade.php:

1. Buka file resources/views/admin/settings.blade.php di editor teks
2. Perhatikan baris terakhir file tersebut, mungkin terlihat seperti:

```
</script>
@endpush
</script>
@endsection
@endpush
```

3. Hapus/Edit baris tersebut dan ganti dengan urutan penutup tag yang benar:

```
</script>
@endsection

@push('scripts')
<script>
// Tag JavaScript lainnya...
</script>
@endpush
```

4. Pastikan urutan tag penutup adalah:
   - Pertama: penutup </script>
   - Kedua: @endsection (untuk menutup section content)
   - Ketiga: @endpush (untuk menutup push scripts)
   
5. Simpan file dan refresh halaman admin settings
*/ 