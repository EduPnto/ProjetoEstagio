<div class="SubMenu-container">
    <?php
        require $_SERVER['DOCUMENT_ROOT'] . '/ProjetoEstagio/BackEnd/DataBase/db_connect.php';

        if ($conn->connect_error) {
            echo "<div class='alert alert-danger'>Erro de ligação à base de dados.</div>";
            exit;
        }

        // Consulta presidentes, sigla e nome completo da entidade correspondente
        $sql = "SELECT p.nome_Pres as nome, p.frase_pres as frase, p.foto_pres as foto, p.Id_Enti as entidade, e.Sigla as sigla, e.nome as nome_enti
        FROM presidentes p
        LEFT JOIN entidades e ON p.Id_Enti = e.Id_Enti
        ORDER BY p.Id_Pres ASC";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0):
        $numPresidentes = $result->num_rows;
    ?>
    <div id="presidentesCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000" style="max-width: 600px; margin: 40px auto;">
        <div class="carousel-inner position-relative" style="min-height: 260px;">
            <?php
                $active = "active";
                $result->data_seek(0);
                while ($row = $result->fetch_assoc()):
                    $nome = htmlspecialchars($row['nome']);
                    $frase = htmlspecialchars($row['frase']);
                    $sigla = htmlspecialchars($row['sigla']);
                    $nomeEnti = htmlspecialchars($row['nome_enti']);
                    $fotoData = $row['foto'];
                    $imgSrc = '';
                if (!empty($fotoData)) {
                    $imgSrc = 'data:image/jpeg;base64,' . base64_encode($fotoData);
                } else {
                    $imgSrc = '/ProjetoEstagio/FrontEnd/Icons/user.png';
                }
            ?>
            <div class="carousel-item text-center <?= $active ?>">
                <div class="d-flex align-items-center justify-content-center" style="position: relative;">
                    <button class="carousel-control-prev position-static" type="button" data-bs-target="#presidentesCarousel" data-bs-slide="prev" style="background: none; border: none; margin-right: 10px; height: 150px; display: flex; align-items: center;">
                        <span class="carousel-control-prev-icon" aria-hidden="true" style="filter: invert(1); width: 32px; height: 32px;"></span>
                        <span class="visually-hidden">Anterior</span>
                    </button>
                    <img src="<?= $imgSrc ?>" class="d-block mx-auto rounded-circle" alt="<?= $nome ?>" style="width: 150px; height: 150px; object-fit: cover;">
                    <button class="carousel-control-next position-static" type="button" data-bs-target="#presidentesCarousel" data-bs-slide="next" style="background: none; border: none; margin-left: 10px; height: 150px; display: flex; align-items: center;">
                        <span class="carousel-control-next-icon" aria-hidden="true" style="filter: invert(1); width: 32px; height: 32px;"></span>
                        <span class="visually-hidden">Próximo</span>
                    </button>
                </div>
                <h5 class="mt-3"><?= $nome ?></h5>
                <p class="text-muted mb-0" style="font-size: 0.95em;">Presidente da <strong><?= $sigla ?></strong></p>
                <p class="text-muted mb-0" style="font-size: 0.95em;">(<?= $nomeEnti ?>)</p>
                <br>
                <p class="fst-italic">"<?= $frase ?>"</p>
            </div>
            <?php $active = ""; endwhile; ?>
        </div>
        <div class="carousel-indicators" style="position: static; margin-top: 10px;">
            <?php for ($i = 0; $i < $numPresidentes; $i++): ?>
                <button type="button" data-bs-target="#presidentesCarousel" data-bs-slide-to="<?= $i ?>" <?= $i === 0 ? 'class="active"' : '' ?> aria-current="<?= $i === 0 ? 'true' : 'false' ?>" aria-label="Slide <?= $i+1 ?>" style="background-color: #333; width: 10px; height: 10px; border-radius: 50%; margin: 0 4px; border: none;"></button>
            <?php endfor; ?>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var carousel = document.querySelector('#presidentesCarousel');
            if (carousel) {
                var bsCarousel = bootstrap.Carousel.getOrCreateInstance(carousel, { interval: 4000, ride: 'carousel', wrap: true });
                bsCarousel.cycle();
            }
        });
    </script>
    <?php
        else:
        echo "<div class='text-center my-4'>Nenhum presidente encontrado.</div>";
        endif;
        $conn->close();
    ?>
</div>