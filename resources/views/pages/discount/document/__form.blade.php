<h5 class="mb-3">Список брендов</h5>
<table id="brand_discounts" class="table table-striped table-bordered datatable mb-0">
    <tr>
        <th>Бренд</th>
        <th>Процент скидки</th>
        <th>Рекдактирование</th>
    </tr>
    @foreach($selectedBrands as $brand)
        <tr id="row{{$brand->manufacturer_id}}">
                <td><input class='form-control w-100' type="hidden"  type='text' name='brand_discounts[{{$brand->manufacturer_id}}][brand]' value="{{$brand->manufacturer_id}}">{{$brand->manufacturer_name}}</td>
                <td id="country_row{{$brand->manufacturer_id}}">
                    <input class='form-control w-100' type="hidden"  type='text' name='brand_discounts[{{$brand->manufacturer_id}}][percent]' value="{{$brand->percent}}">{{$brand->percent}}
                <td>
                    <input type="button" value="Delete" class='add btn btn-outline-dark' type='button' onclick="delete_row(brand_discounts, '{{$brand->manufacturer_id}}')">
                </td>
        </tr>
    @endforeach

    <tr>
        <td>
            <select class="form-control w-100" id="brand">
                @foreach($manufacturers as $id => $manufacturer)
                    <option data-label="{{$manufacturer}}" value="{{ $id }}">{{ $manufacturer }}</option>
                @endforeach
            </select>
        </td>
        <td><input name="" class="form-control w-100" type="text" id="percent"></td>
        <td><input type="button" class="add btn btn-outline-dark"
                   id="brand-button"
                   onclick="new_row('brand_discounts', ['brand' , 'percent'])"
                   value="{{ trans('buttons.add') }}"></td>
    </tr>
</table> <br>

<h5 class="mb-3">Список Клиентов</h5>
<table id="clients" class="table table-striped table-bordered datatable mb-0">
    <tr>
        <th>Клиенты</th>
        <th>Редактирование</th>
    </tr>
    @foreach($selectedClients as $id => $client)
        <tr id="row{{$id}}">
            <td><input class='form-control w-100' type="hidden"  type='text' name='clients[{{$id}}][client]' value="{{$id}}">{{$client}}</td>
            <td>
                <input type="button" value="Delete" class='add btn btn-outline-dark' type='button' onclick="delete_row(clients, '{{$id}}')">
            </td>
        </tr>
    @endforeach
    <tr>
        <td>
            <select class="form-control w-100" id="client">
                @foreach($clients as $id => $clientName)
                    <option value="{{ $id }}"  data-test="12" data-label="{{ $clientName }}" >{{ $clientName }}</option>
                @endforeach
            </select>
        </td>
        <td><input class="add form-control w-100" type="button"
                   onclick="new_row('clients', ['client']);" value="Add Row">
        </td>
    </tr>
</table> <br>

<h5 class="mb-3">Период</h5>
<table class="table table-striped table-bordered datatable">
    <tbody>
    @include('partials.input', ['input' => 'date', 'field' => 'start_date', 'label' => 'Дата начала действия скидки'])
    @include('partials.input', ['input' => 'date', 'field' => 'end_date', 'label' => 'Дата окончания действия скидки'])
    </tbody>
</table>


<br>


@section('scripts')
    <script>
        function new_row(table_name, columns) {
            let table = document.getElementById(table_name);

            let line_number = (table.rows.length) - 1;
            let rowId = 'row' + line_number;
            let row = `<tr id="${rowId}">`;
            let tdId;

            columns.forEach((element, id) => {
                tdId = element + line_number;
                let input = $('#' + element);
                let inputValue = input.val();
                let label = input.find(`option[value="${inputValue}"]`).data('label');

                row += `<td id='${tdId}'>
                            <span>${label ?? inputValue}</span>
                            <input type="hidden" class='form-control w-100' name='${table_name}[${line_number}][${element}]' value=${inputValue}>
                        </td>`
            }, this);


            row +=
                "<td>" +
                // "<input  class='add btn btn-outline-dark' type='button' id='edit_button" + line_number + "' value='Edit'  onclick='edit_row(" + table_name + ", " + line_number + ")'>" +
                "<input class='add btn btn-outline-dark' type='button' value='Delete'  onclick='delete_row(" + table_name + ", " + line_number + ")'>" +
                // "<input class='add btn btn-outline-dark' type='button' id='save_button"+line_number+"' value='Save' onclick='save_row(" + table_name + ", " + line_number + ")'> "+
                "</td>";

            row += "</tr>";


            table.insertRow(line_number).outerHTML = row;

            // console.log($('#' + tdId).data('name'))

            columns.forEach((element) => {
                document.getElementById(element).value = "";
            }, this);
        }

        // function edit_row(table_name, line_number) {
        //     document.getElementById("edit_button" + line_number).style.display = "none";
        //     document.getElementById("save_button" + line_number).style.display = "block";
        //     $(table_name).find(`#row${line_number}`).attr('contenteditable', 'true')
        // }
        //
        // function save_row(table_name, line_number) {
        //     $(table_name).find(`#row${line_number}`).attr('contenteditable', 'false')
        //     document.getElementById("edit_button" + line_number).style.display = "block";
        //     document.getElementById("save_button" + line_number).style.display = "none";
        // }

        function delete_row(table_name, line_number) {
            // console.log($(table_name));
            $(table_name).find(`#row${line_number}`).remove();
        }

    </script>
@endsection
