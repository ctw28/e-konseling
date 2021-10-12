@extends('admin.template')

@section('css')
<style>
.question_nav {
    width: 100%;
    text-align: center;
}

.question_nav a {
    width: 40px;
    display: inline-block;
    background-color: red;
    color: #fff;
}

.question_active {
    border: 1px solid yellow;
    background-color: orange !important;
    color: #000 !important;
    font-weight: bold !important;
}

.answered {
    background-color: green !important;
}

.navigation_page {
    list-style-type: none !important;
    padding: 0;
}

.navigation_page li {
    display: inline-block !important;
}
</style>


@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Pertanyaan <span id="questionNumberInfo"></span></h3>
    </div>
    <div class="card-body">
        <p id="question"></p>
        <div class="col-sm-12">
            <div class="custom-control custom-radio col-sm-2" id="choice_yes">
                <input class="custom-control-input custom-control-input-info" type="radio" id="jawaban_ya"
                    name="jawaban" value="1">
                <label for="jawaban_ya" class="custom-control-label">Ya</label>
            </div>
            <div class="custom-control custom-radio col-sm-2" id="choice_no">
                <input class="custom-control-input custom-control-input-info" type="radio" id="jawaban_tidak"
                    name="jawaban" value="0">
                <label for="jawaban_tidak" class="custom-control-label">Tidak</label>
            </div>
        </div>
        <div id="questionButton" style="margin-top:20px">
            <button class="btn btn-info" id="btnNext"><i class="fa fa-save"></i>&nbsp Simpan dan Lanjut</button>
            <button class="btn btn-default" id="btnSkip">Lewati</button>
            <a href="{{route('assesment.score',Crypt::encrypt($data['dataSesi']->id))}}" class="btn btn-warning"
                id="btnFinish">Selesai</a>
        </div>
    </div>
    <div class="card-footer">
        <h4>Navigasi Pertanyaan</h4>

        <ul class="navigation_page">
            <li><a href="javascript:navigationQuestions(0)" class="btn btn-xs btn-warning" id="pagePrev">
                    <i class="fa fa-arrow-alt-circle-left"></i> &nbsp Sebelumnya</a>
            </li>
            <li><a href="javascript:navigationQuestions(100)" class="btn btn-xs btn-warning" id="pageNext">Selanjutnya
                    &nbsp
                    <i class="fa fa-arrow-alt-circle-right"></i></a>
            </li>
        </ul>
        <div id="container">
        </div>
        <h6 style="margin-top: 10px">Keterangan</h6>
        <p><i>Merah : Belum Terjawab, Hijau : Sudah terjawab, Orange : Soal Aktif</i></p>
    </div>
</div>
@endsection

@section('js')
<script>
getQuestion(1) //menuju ke soal nomor 1 ketika halaman pertama kali dibuka
navigationQuestions(0) //set navigasi pertanyaan ketika halaman pertama kali dibuka

async function navigationQuestions(page) { //untuk mengeset navgiasi
    document.querySelector("#container").innerHTML = ''
    const totalData = 330
    const rowCount = 4
    const colCount = 25
    let prevPage = (page == 0) ? 0 : page - 100
    let nextPage = (page + 100 > totalData) ? 0 : page + 100
    const prevPageButton = document.querySelector("#pagePrev")
    const nextPageButton = document.querySelector("#pageNext")
    getQuestion(page + 1) //arahkan soal yg tampil sesuai dengan page
    prevPageButton.href = `javascript:navigationQuestions(${prevPage})`
    nextPageButton.href = `javascript:navigationQuestions(${nextPage})`
    let rentangSoalBawah = (page == 0) ? 1 : page
    let rentangSoalAtas = (page + 100 > totalData) ? totalData : page + rowCount * colCount
    document.querySelector('#questionNumberInfo').innerText = `${rentangSoalBawah} - ${rentangSoalAtas}`

    let answeredQuestion = []
    let url = "{{route('assesment.get.jawab',':sessionId')}}" //ambil nomor-nomor soal yang sudah dijawab    
    url = url.replace(':sessionId', "{{$data['dataSesi']->id}}")
    let response = await fetch(url)
    let responseMessage = await response.json()
    responseMessage.map(row => {
        answeredQuestion.push(row.assesment_id)
    })

    function makeElement(tag, content) { //membuat element table untuk navigasi
        const createdElement = document.createElement(tag)
        content.some(c => {
            if (tag == "td") {
                if (c > totalData) return
                let link = document.createElement('a')
                link.appendChild(document.createTextNode(c))
                link.href = `javascript:goToQuestion(${c})`
                link.title = `Menuju ke pertanyaan nomor ${c}`
                link.id = `question_${c}`
                link.className = "number"
                if (answeredQuestion.includes(c)) link.classList.add('answered')
                createdElement.appendChild(link)
            } else {
                if (tag == "table") c.className = 'question_nav'
                createdElement.appendChild(c)
            }
        })
        return createdElement
    }


    document.querySelector("#container").appendChild(makeElement(
        "table", [...Array(rowCount).keys()].map(row => makeElement(
            "tr", [...Array(colCount).keys()].map(column => makeElement(
                "td", [page + row * 25 + column + 1]
            ))
        ))
    ))
}

async function getQuestion(no_urut) { //menampilkan pertanyaan sesuai nomor yang dipilih
    let url = "{{route('assesment.get.soal',[':id',':no_urut'])}}"
    url = url.replace(':id', "{{$data['dataSesi']->id}}")
    url = url.replace(':no_urut', no_urut)
    let response = await fetch(url)
    let responseMessage = await response.json()
    if (responseMessage.length == 0) {
        getQuestion(1)
        navigationQuestions(0)
        return
    }
    document.querySelector('#question').innerText = `${responseMessage.soal.no_urut}. ${responseMessage.soal.soal}`

    let buttonSaveNext = document.querySelector('#btnNext')
    buttonSaveNext.onclick = function() {
        saveAndGoToNextQuestion(responseMessage.soal.id, responseMessage.soal.no_urut)
    }
    let buttonSkip = document.querySelector('#btnSkip')
    buttonSkip.onclick = function() {
        goToQuestion(responseMessage.soal.soal_setelah)
    }
    let yesAnswer = document.querySelector('#jawaban_ya')
    let noAnswer = document.querySelector('#jawaban_tidak')
    if (responseMessage.jawaban != null) {
        (responseMessage.jawaban.jawaban === "1") ? yesAnswer.checked = true: noAnswer.checked = true
    } else {
        yesAnswer.checked = false
        noAnswer.checked = false
    }
}

function removeQuestionActiveClass() { //hilangkan css aktif ketika navigasi ke nomor lain
    let childrens = document.querySelectorAll('.number')
    childrens.forEach(function(e) {
        e.classList.remove('question_active')
    })
}

function goToQuestion(no_urut) { //menuju ke nomor pertanyaan sesuai yang dipilih
    getQuestion(no_urut)
    removeQuestionActiveClass()
    document.querySelector(`#question_${no_urut}`).classList.add('question_active')
}

async function saveAndGoToNextQuestion(id, no_urut) { //simpan jawaban dan menuju ke nomor selanjutnya
    let jawaban = document.querySelector('input[name="jawaban"]:checked')
    if (jawaban === null) return alert('Mohon pilih jawaban')
    let dataSend = new FormData()
    dataSend.append('assesment_id', id)
    dataSend.append('assesment_sesi_id', "{{$data['dataSesi']->id}}")
    dataSend.append('jawaban', jawaban.value)
    let response = await fetch("{{route('assesment.save')}}", {
        method: "POST",
        body: dataSend
    })
    let responseMessage = await response.json()
    if (responseMessage.status === 0) {
        alert('terjadi kesalahan pada sistem, mohon coba lagi')
        return
    } else {
        let nextQuestionNumber = parseInt(no_urut + 1)
        document.querySelector(`#question_${no_urut}`).classList.add('answered')
        getQuestion(nextQuestionNumber)
        removeQuestionActiveClass()
        document.querySelector(`#question_${nextQuestionNumber}`).classList.add('question_active')
    }
}
</script>
@endsection