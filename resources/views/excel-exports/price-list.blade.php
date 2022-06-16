<table>
    <thead>
    <tr>
        <th>Производитель</th>
        <th>Бренд</th>
        <th>Наименование</th>
        <th>Артикул</th>
        <th>Код товара</th>
        <th>Применяемость</th>
    </tr>
    </thead>
    <tbody>
    @foreach($rows as $row)
        <tr>
            <td>{{ $row->manufacturerName }}</td>
            <td>{{ $row->productBrand }}</td>
            <td>{{ $row->productName }}</td>
            <td>{{ $row->productArticle }}</td>
            <td>{{ $row->productCode }}</td>
            <td>{{ $row->productApplicability }}</td>
        </tr>
    @endforeach
    </tbody>
</table>