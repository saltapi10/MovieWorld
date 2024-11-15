import './bootstrap';
import 'bootstrap/dist/js/bootstrap.bundle.min';
import $ from "jquery";

document.addEventListener("DOMContentLoaded", function () {
    document.addEventListener("click", function(event) {
        // a more front end approach in submit form
        if (!event.target.closest('.button_reaction')) {
            return;
        }

        let clicker = event.target.closest('.button_reaction');

        event.preventDefault();

        let reactions_buttons_container = clicker.closest('.reactions_buttons_container');

        let likesNumber = clicker.closest('.card-body').querySelector('span.likes_count');
        let hatesNumber = clicker.closest('.card-body').querySelector('span.hates_count');

        //console.log(hatesNumber);

        let csrf_token = document.querySelector('meta[name="csrf-token"]').content;

        (async () => {
            const rawResponse = await fetch('/movie-reaction', {
                method: 'POST',
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json, text-plain, */*",
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-TOKEN": csrf_token
                },
                body: JSON.stringify({
                    'movie_id': clicker.getAttribute('data-movie-id'),
                    'reaction_type': clicker.getAttribute('data-reaction'),
                })
            });
            const content = await rawResponse.json();
            if(content.message){
                alert(content.message);
            }else{

                console.log(content.reaction);

                //console.log(reactions_buttons_container);

                if(content.reaction == 'like'){
                    reactions_buttons_container.querySelector('.button_like').classList.add('btn-success','text-white');
                    reactions_buttons_container.querySelector('.button_hate').classList.remove('btn-danger','text-white');
                }else if(content.reaction == 'hate'){
                    reactions_buttons_container.querySelector('.button_like').classList.remove('btn-success','text-white');
                    reactions_buttons_container.querySelector('.button_hate').classList.add('btn-danger','text-white');
                }else{
                    reactions_buttons_container.querySelector('.button_like').classList.remove('btn-success','text-white');
                    reactions_buttons_container.querySelector('.button_hate').classList.remove('btn-danger','text-white');
                }

                likesNumber.innerText = content.likes;
                hatesNumber.innerText = content.hates;

            }
        })();


    });

    document.getElementsByName('radio_sorting').forEach(function(element) {
        element.onclick = function() {
            window.location.href = "/set-sort-type-movies/" + this.value;
        }
    });

});
