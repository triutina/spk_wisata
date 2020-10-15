<?php
    session_start();
    error_reporting(0);
    if(empty($_SESSION['id'])){
        header('location:login.php?error_login=1');
    }
?>
<?php include 'partials/header.php';?>
    <div class="content">
        <div class="container">
            <div class="row">
            <br/>
                <div class="col-md-12">
                    <h4 class="page-head-line">Proses SPK</h4>
                </div>
            </div>
            <div class="row">
                <h3>Tabel Hasil Perhitungan</h3>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>### </th>
                                <?php foreach ($db->select('kriteria','kriteria')->get() as $k): ?>
                                <th>
                                    <?php
                                        $tmp = explode('_',$k['kriteria']);
                                        echo ucwords(implode(' ',$tmp));
                                    ?>
                                </th>
                                <?php endforeach ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach ($db->select('alternatif.nama,hasil_tpa.*','alternatif,hasil_tpa')->where('alternatif.id_alternatif=hasil_tpa.id_alternatif')->get() as $data):
                            ?>
                                <tr>
                                    <td><?= $data['nama']?></td>
                                    <?php foreach ($db->select('kriteria','kriteria')->get() as $td): ?>
                                    <td><?= $data[$td['kriteria']]?></td>
                                    <?php endforeach ?>
                                </tr>
                            <?php
                                endforeach;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <button class="btn btn-lg" onclick="tpl()">PROSES</button>
                </div>
            </div>
            <br>
            <div id="proses_spk" style="display: none;">
                <div class="row">
                <h3>Normalisasi</h3>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>### </th>
                                <?php foreach ($db->select('kriteria','kriteria')->get() as $k): ?>
                                <th>
                                    <?php
                                        $tmp = explode('_',$k['kriteria']);
                                        echo ucwords(implode(' ',$tmp));
                                    ?>
                                </th>
                                <?php endforeach ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach ($db->select('alternatif.nama,hasil_tpa.*','alternatif,hasil_tpa')->where('alternatif.id_alternatif=hasil_tpa.id_alternatif')->get() as $data):
                            ?>
                                <tr>
                                    <td><?= $data['nama']?></td>
                                    <?php foreach ($db->select('kriteria','kriteria')->get() as $td): ?>
                                    <td><?= $db->rumus($data[$td['kriteria']],$td['kriteria']);?></td>
                                    <?php endforeach ?>
                                </tr>
                            <?php
                                endforeach;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <h3>Proses Penentuan</h3>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Nama </th>
                                <th>Hasil</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach ($db->select('alternatif.id_alternatif,alternatif.nama,hasil_tpa.*','alternatif,hasil_tpa')->where('alternatif.id_alternatif=hasil_tpa.id_alternatif')->get() as $data):
                            ?>
                                <tr>
                                    <td><?= $data['nama']?></td>
                                    <td>
                                    <?php 
                                        $hasil = [];
                                        foreach($db->select('kriteria','kriteria')->get() as $dt){
                                            array_push($hasil,$db->rumus($data[$dt['kriteria']],$dt['kriteria'])*$db->bobot($dt['kriteria']));
                                        }
                                        echo $h = array_sum($hasil);
                                        if($db->select('id_alternatif','hasil_spk')->where("id_alternatif='$data[id_alternatif]'")->count() == 0){
                                            $db->insert('hasil_spk',"'','$data[id_alternatif]','$h'")->count();
                                        } else {
                                            $db->update('hasil_spk',"hasil_spk='$h'")->where("id_alternatif='$data[id_alternatif]'")->count();
                                        }
                                        
                                        ?>
                                    </td>
                                </tr>
                            <?php
                                endforeach;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <h3>Perankingan</h3>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Hasil </th>
                                <?php $no = 1; foreach ($db->select('kriteria','kriteria')->get() as $th): ?>
                                <th>K<?= $no?></th>
                                <?php $no++; endforeach ?>
                                <th rowspan="2" style="padding-bottom:25px">Hasil</th>
                                <th rowspan="2" style="padding-bottom:25px">Ranking</th>
                            </tr>
                            <tr>
                                <th>Bobot </th>
                                <?php foreach ($db->select('bobot','kriteria')->get() as $th): ?>
                                <th><?= $th['bobot']?></th>
                                <?php endforeach ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no = 1;
                                foreach ($db->select('distinct(alternatif.nama),hasil_tpa.*','alternatif,hasil_tpa,hasil_spk')->where('alternatif.id_alternatif=hasil_tpa.id_alternatif and alternatif.id_alternatif=hasil_spk.id_alternatif')->order_by('hasil_spk.hasil_spk','desc')->get() as $data):
                            ?>
                                <tr>
                                    <td><?= $data['nama']?></td>
                                    <?php foreach ($db->select('kriteria','kriteria')->get() as $td): ?>
                                    <td><?= $db->rumus($data[$td['kriteria']],$td['kriteria']);?></td>
                                    <?php endforeach ?>
                                    <td>
                                    <?php 
                                        $hasil = [];
                                        foreach($db->select('kriteria','kriteria')->get() as $dt){
                                            array_push($hasil,$db->rumus($data[$dt['kriteria']],$dt['kriteria'])*$db->bobot($dt['kriteria']));
                                        }
                                        echo $r = array_sum($hasil);
                                    ?>
                                    </td>
                                    <td>
                                        <?= $no?>
                                    </td>
                                </tr>
                            <?php
                                $no++;
                                endforeach;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>    
            </div>
            
    </div>
    <!-- CONTENT-WRAPPER SECTION END-->
<?php include 'partials/footer.php'; ?>
<script type="text/javascript">
    $(function(){
        $("#proses").addClass('menu-top-active');
        // $.ajax({
        //     url:'truncate_tpa.php',
        //     success:function(data){
        //         //alert(data);
                    
        //     }
        // });
    });
    function tpl(){
        $("#proses_spk").show();    
    }
</script>
