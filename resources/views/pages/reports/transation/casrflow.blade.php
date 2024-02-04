@extends('pages.layout')
@section('title')
Report || Case Flow
@endsection
@section('content')

<style>
    .dataTable-top,
    .dataTable-bottom {
      flex-wrap: wrap;
      justify-content: space-between;
      row-gap: 10px;
    }
  
    .dataTable-table th {
      border-right: 1px solid #e5e5e5;
      text-align: center;
    }
  
    #mytable tbody tr td {
      text-align: center;
    }
  
    .table_top {
      display: flex;
      justify-content: flex-end;
      align-items: center;
      margin-bottom: 10px;
  }
  </style>

<div class="row g-gs">
    <div class="col-xl-12 col-sm-12 px-0">
      <div class="card">
        <div class="card-body">
          <div class="total_mnth_select">
            <div class="mnth_select">

              <div class="form-group">
                <div class="form-control-wrap">
                  <select class="form-select" id="exampleFormControlInputText5"
                    aria-label="Default select example">
                    <option selected>This Month</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="date_select">
              <p>Between</p>

              <div class="form-group">
                <div class="form-control-wrap">
                  <input placeholder="dd/mm/yyyy" type="text" class="form-control-sm js-datepicker"
                    data-today-btn="true" data-clear-btn="true" autocomplete="off" id="datePicker1">
                </div>
              </div>

              <p style="background-color: transparent; color: #000;">to</p>
              <div class="form-group">
                <div class="form-control-wrap">
                  <input placeholder="dd/mm/yyyy" type="text" class="form-control-sm js-datepicker"
                    data-today-btn="true" data-clear-btn="true" autocomplete="off" id="datePicker1">
                </div>
              </div>
            </div>

            <div class="firm_selct">

              <div class="form-check form-check-sm">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                  Show zero amount transactions
                </label>
              </div>
            </div>

          </div>

          <p class="cash_hand_amount">Opening cash in hand: ₹2,04,094.00</p>


        </div>
      </div>
    </div>

    <div class="col-xl-12 col-sm-12 mt-2 px-0">
      <div class="card">
        <div class="card-body">
          <div class="table_top">
            <div class="btn_grp" >
              <div class="btn-group btn-group-sm" role="group" aria-label="Basic outlined example">
                <button type="button" class="btn btn-outline-warning" id="export-button">Excel</button>
                <button type="button" class="btn btn-outline-danger" id="export-button-pdf">PDF</button>
              </div>
             
            </div>

          </div>

          <table id="mytable" width="100%" class="datatable-init table"
            data-nk-container="table-responsive table-border">
            <thead>
              <tr>
                <th>
                  <span class="overline-title">Date</span>
                </th>


                <th>
                  <span class="overline-title">Ref No</span>
                </th>
                <th>
                  <span class="overline-title">Name</span>
                </th>
                <th>
                  <span class="overline-title">Category</span>
                </th>
                <th>
                  <span class="overline-title">type</span>
                </th>
                <th>
                  <span class="overline-title">Cash In(₹)</span>

                </th>

                <th>
                  <span class="overline-title">Cash Out(₹)</span>

                </th>
                <th>
                  <span class="overline-title">Running(₹)</span>
                </th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>22.2.23</td>
                <td>23456</td>
                <td>Alfred</td>
                <td>61</td>
                <td>61</td>
                <td>₹ 6100.00</td>
                <td>₹ 6100.00</td>
                <td>₹ 6100.00</td>


              </tr>
            </tbody>
          </table>


        </div>

        <div class="card-body px-0">
          <div class="total_sale_amount">
            <div class="col-xl-3 col-sm-12">
              <p style="color: #3d8f0a; ">Total cash-in: <span style="font-weight: 600;">₹18,3420.00</span> </p>
            </div>

            <div class="col-xl-3 col-sm-12">
                <p style="text-align: right; color: red;">Total cash out: <span style=" font-weight: 600;">₹15,230.00</span> </p>
            </div>

            <div class="col-xl-3 col-sm-12">
              <p style="text-align: right;color: #3d8f0a; ">closing Cash In Hand: <span style="font-weight: 600;">₹15,230.00</span> </p>
          </div>


           </div>
        </div>

      </div>
    </div>

  </div>

  <script>
    document
      .getElementById("export-button")
      .addEventListener("click", function () {
        const table = document.getElementById("mytable");
        const rows = table.querySelectorAll("tbody tr");
  
        let csvContent = "data:text/csv;charset=utf-8,";
  
        csvContent += "Name,Age,Location\n";
  
        rows.forEach(function (row) {
          const columns = row.querySelectorAll("td");
          const rowData = Array.from(columns)
            .map((column) => column.textContent)
            .join(",");
          csvContent += rowData + "\n";
        });
  
        const blob = new Blob([csvContent], {
          type: "text/csv;charset=utf-8;",
        });
  
        const link = document.createElement("a");
        link.href = URL.createObjectURL(blob);
        link.download = "data.csv";
        link.style.display = "none";
  
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
      });
  
    // 2nd income data table
  
    document
      .getElementById("export-xl-incm")
      .addEventListener("click", function () {
        const table = document.getElementById("mytable-income");
        const rows = table.querySelectorAll("tbody tr");
  
        let csvContent = "data:text/csv;charset=utf-8,";
  
        csvContent += "Name,Age,Location\n";
  
        rows.forEach(function (row) {
          const columns = row.querySelectorAll("td");
          const rowData = Array.from(columns)
            .map((column) => column.textContent)
            .join(",");
          csvContent += rowData + "\n";
        });
  
        const blob = new Blob([csvContent], {
          type: "text/csv;charset=utf-8;",
        });
  
        const link = document.createElement("a");
        link.href = URL.createObjectURL(blob);
        link.download = "data.csv";
        link.style.display = "none";
  
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
      });
  </script>
  
  
  
  <script>
    document.getElementById("export-button-pdf").addEventListener("click", function () {
      const table = document.getElementById('mytable');
      const rows = table.querySelectorAll('tbody tr');
  
      let csvContent = '\n,';
  
      csvContent += 'Name,Age,Location\n';
  
      rows.forEach(function (row) {
        const columns = row.querySelectorAll('td');
        const rowData = Array.from(columns).map(column => column.textContent).join(',');
        csvContent += rowData + '\n';
      });
  
      var lines = csvContent.split("\n");
      var pdfContent = lines.map(line => line.split(",").join("\t")).join("\n");
  
      var pdfWindow = window.open('', '', 'height=650,width=900');
      pdfWindow.document.write('<pre>' + pdfContent + '</pre>');
      pdfWindow.document.close();
      pdfWindow.print();
  
    })
  
  </script>

@endsection