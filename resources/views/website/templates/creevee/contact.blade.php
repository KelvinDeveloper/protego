<section id="contact">

    <div class="row section-head">

        <div class="two columns header-col">

            <h1><span>Get In Touch.</span></h1>

        </div>

        <div class="ten columns">

            <p class="lead">{{ $Contact->description }}</p>

        </div>

    </div>

    <div class="row">

        <div class="height columns" style="width: 100% !important;">

            <!-- form -->
            <form action="" method="post" id="contactForm" name="contactForm">

                {{ csrf_field() }}

                <fieldset>

                    <div>
                        <label for="contactName">Nome <span class="required">*</span></label>
                        <input type="text" value="" size="35" id="contactName" name="contactName" required>
                    </div>

                    <div>
                        <label for="contactEmail">Email <span class="required">*</span></label>
                        <input type="text" value="" size="35" id="contactEmail" name="contactEmail" required>
                    </div>

                    <div>
                        <label for="contactSubject">Assunto</label>
                        <input type="text" value="" size="35" id="contactSubject" name="contactSubject">
                    </div>

                    <div>
                        <label for="contactMessage">Messagem <span class="required">*</span></label>
                        <textarea cols="50" rows="15" id="contactMessage" name="contactMessage" required></textarea>
                    </div>

                    <div>
                        <button class="submit">Enviar</button>
                        <span id="image-loader">
                        <img alt="" src="/creevee/images/loader.gif">
                     </span>
                    </div>

                </fieldset>
            </form> <!-- Form End -->

            <!-- contact-warning -->
            <div id="message-warning"> Ops... algo deu errado :(</div>
            <!-- contact-success -->
            <div id="message-success">
                <i class="fa fa-check"></i>Sua mensagem foi enviada, obrigado!<br>
            </div>

        </div>


    </div>

</section>