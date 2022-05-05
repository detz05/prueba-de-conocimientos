var elem = null;
doc = document;

function submitForm(e){
    e.preventDefault();
    var name = doc.getElementById('name').value;
    var parOne = doc.getElementById('par_one').value;
    var parTwo = doc.getElementById('par_two').value;
    var parThree = doc.getElementById('par_three').value;
    var isEdit = elem == null ? false : true;

    if(name.length == 0){ alert("El campo Nombre no debe estar vacio."); return; }
    if(parOne.length == 0){ alert("El campo Parcial °1 no debe estar vacio."); return; }
    if(parTwo.length == 0){ alert("El campo Parcial °2 no debe estar vacio."); return; }
    if(parThree.length == 0){ alert("El campo Parcial °3 no debe estar vacio."); return; }

    
    if(parseFloat(parOne) < 1 || parseFloat(parOne) > 5){ alert("El valor del campo Parcial °1 debe ser minimo 1 y maximo 5."); return; }
    if(parseFloat(parTwo) < 1 || parseFloat(parTwo) > 5){ alert("El valor del campo Parcial °2 debe ser minimo 1 y maximo 5."); return; }
    if(parseFloat(parThree) < 1 || parseFloat(parThree) > 5){ alert("El valor del campo Parcial °3 debe ser minimo 1 y maximo 5."); return; }

    let data = { name: name, parOne: parOne, parTwo: parTwo, parThree: parThree, isEdit: isEdit, id: isEdit ? elem.cells[0].innerHTML : 0 };
    fetch("simulation.php", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(data => {
        if(data){
            let getTable = doc.getElementById("list")
                              .getElementsByTagName('tbody')[0];
            if(!isEdit){
        
                let newRow = getTable.insertRow(getTable.length);
        
                cell1 = newRow.insertCell(0);
                cell1.innerHTML = getTable.children.length;
                cell2 = newRow.insertCell(1);
                cell2.innerHTML = data.name;
                cell3 = newRow.insertCell(2);
                cell3.innerHTML = data.parOne;
                cell4 = newRow.insertCell(3);
                cell4.innerHTML = data.parTwo;
                cell5 = newRow.insertCell(4);
                cell5.innerHTML = data.parThree;
                cell6 = newRow.insertCell(5);
                cell6.innerHTML = (((parseFloat(data.parOne) + parseFloat(data.parTwo)) + parseFloat(data.parThree))/3).toFixed(2);
                cell7 = newRow.insertCell(6);
                cell7.innerHTML = `<button onclick="edit(this)" type="button" class="btn btn-sm btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                   <button onclick="del(this)" type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>`;
            }else{
                elem.cells[0].innerHTML = data.id;
                elem.cells[1].innerHTML = data.name;
                elem.cells[2].innerHTML = data.parOne;
                elem.cells[3].innerHTML = data.parTwo;
                elem.cells[4].innerHTML = data.parThree;
                elem.cells[5].innerHTML = (((parseFloat(data.parOne) + parseFloat(data.parTwo)) + parseFloat(data.parThree))/3).toFixed(2);
                doc.getElementById("btn_submit").innerText = 'Guardar';
                elem = null;
            }
        }
        doc.getElementById('name').value = '';
        doc.getElementById('par_one').value = '';
        doc.getElementById('par_two').value = '';
        doc.getElementById('par_three').value = '';
    })
    .catch(error => {
        console.log(error)
    });

}

function edit(e) {
    elem = e.parentElement.parentElement;
    doc.getElementById("name").value = elem.cells[1].innerHTML;
    doc.getElementById("par_one").value = elem.cells[2].innerHTML;
    doc.getElementById("par_two").value = elem.cells[3].innerHTML;
    doc.getElementById("par_three").value = elem.cells[4].innerHTML;
    doc.getElementById("btn_submit").innerText = 'Actualizar';
}

function del(id) {
    if (confirm('Está usted seguro que desea eliminar este registro?')) {
        row = id.parentElement.parentElement;
        
        let data = { isEdit: false, id: row.cells[0].innerText };
        fetch("simulation.php", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            if(data){
                doc.getElementById("list").deleteRow(row.rowIndex);
            }else{
                alert("No se pudo eliminar el registro");
            }
        })
    }
}


var onlytext = (e) => {
    e.target.value = e.target.value.replace(/[^A-Za-z ]+/g,"");
}

var onlyfloat = (e) => {
    e.target.value = e.target.value.replace(/[^0-9.]+/g,"");
}