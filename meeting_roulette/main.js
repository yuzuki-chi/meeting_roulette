function AddRow() {
    var div = document.getElementById("memberList");
    rowCnt++;

    const inputNum = document.createElement("input");
    inputNum.type = "text";
    inputNum.size = "10";
    inputNum.name = "number" + rowCnt;
    const rowNum = div.appendChild(inputNum);

    const inputName = document.createElement("input");
    inputName.type = "text";
    inputName.name = "name" + rowCnt;
    const rowName = div.appendChild(inputName);

    const deleteButton = document.createElement("button");
    deleteButton.type = "button";
    deleteButton.innerText = "-";
    deleteButton.name = "del" + rowCnt;
    deleteButton.onclick = new Function("DeleteRow("+rowCnt+");");
    const rowDeleteButton = div.appendChild(deleteButton);

    const br = document.createElement("br");
    br.id = "br" + rowCnt;
    const objbr = div.appendChild(br);
}

function DeleteRow(cnt) {
    var div = document.getElementById("memberList");
    const delRowMember = document.getElementsByName("number" + cnt)[0];
    const delRowName = document.getElementsByName("name" + cnt)[0];
    const delRowButton = document.getElementsByName("del" + cnt)[0];
    const delRowBr = document.getElementById("br" + cnt);

    div.removeChild(delRowMember);
    div.removeChild(delRowName);
    div.removeChild(delRowButton);
    div.removeChild(delRowBr);

    console.log(delRowMember);
}