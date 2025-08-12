<section>
    <div class="bg-white p-5">
        <h2 class="mb-3">
            Здесь вы найдете интересные и полезные материалы по финансовой грамотности,
            которые сможете использовать для самостоятельного обучения.
        </h2>
        <ul class="list-inside list-disc mb-3">
            <li class="mb-2">
                <a class="underline underline-offset-3 transition duration-300 ease-linear hover:text-[#C10F1A]" href="https://fincult.info/search/?query=%D0%91%D1%80%D0%BE%D1%88%D1%8E%D1%80%D1%8B&tags=material">Ссылка на материал</a>
            </li>
            <li>
                <a class="underline underline-offset-3 transition duration-300 ease-linear hover:text-[#C10F1A]" href="https://моифинансы.рф/stop-moshennik/">Ссылка на материал</a>
            </li>
        </ul>
        <div class="flex flex-col gap-3">
            <h2 class="font-medium">Дропперы: кто они такие и как не стать соучастником преступления</h2>
            <p>
                С июля 2025 года вводится уголовная ответственность для дропперов. Им грозит штраф до 300 000 рублей, блокировка счетов и вдобавок тюремный срок – до трех лет.
            </p>
            <p>
                Дропперы (дропы) – это посредники, которые предоставляют мошенникам свои карты и счета для вывода украденных средств. За это дропы получают вознаграждение от преступников.
            </p>
            <p>
                Так как жертвы обмана часто переводят деньги дропперам, посредников тоже считают преступниками. Именно на них жертвы пишут заявления в полицию. Затем банк и полиция передают данные человека, засветившегося в мошеннических схемах, в единую базу дропперов, которую ведет Банк России. На основании этих данных  банки ограничивают онлайн-переводы до 100 000 рублей в месяц. А также могут заблокировать карты и отключить доступ к онлайн-банкингу. Снять деньги можно будет только в отделении банка.
            </p>
            <p>
                Чтобы не превратиться в дроппера, не давайте незнакомым людям доступ к своим данным банковской карты или счета. Помните, что привлекают граждан в дропперство разными способами. Часто мошенники дежурят у банкоматов и, прикрываясь проблемами с картой, просят людей принять на свой счет деньги, а затем обналичить за вознаграждение. 
            </p>
            <p>
                Подробнее о том, как мошенники находят дропперов и что делать, если вас втянули в преступную схему, читайте на Финкульт <a href="https://fincult.info/" class="underline transition duration-300 ease-linear hover:text-[#C10F1A]">(https://fincult.info/)</a>.
            </p>
        </div>
    </div>
</section>
<style>
    .left-side-menu li.active a {
        color: #C10F1A !important;
    }
    .left-side-menu li a{
        display: flex;
        gap: 5px
    }
    .left-side-menu li{
        display: flex;
        justify-content: space-between;
    }
    .left-side-menu li div{
        display: flex;
        align-items: center;
    }
    .menu-item-number{
        display: block;
    }
    .grow > h4{
        display: none;
    }
    ul.left-side-menu {
        list-style: none;
        margin: 0;
        padding: 0;
        position: sticky;
        top: 200px;
        max-height: calc(100vh - 40px);
        overflow-y: auto;
        scrollbar-width: thin;
        scrollbar-color: #888 #f1f1f1;
    }
    .left-side-menu-box{
        z-index: 5;
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const menuLinks = document.querySelectorAll('.left-side-menu a');
        const currentUrl = window.location.href;

        menuLinks.forEach(link => {
            const linkUrl = new URL(link.href);
            const cleanLinkUrl = linkUrl.origin + linkUrl.pathname;

            const cleanCurrentUrl = new URL(currentUrl);
            const cleanCurrent = cleanCurrentUrl.origin + cleanCurrentUrl.pathname;

            if (cleanCurrent === cleanLinkUrl) {
            link.classList.add('active-menu-item');
            link.closest('li').classList.add('active');
            }
        });
});
</script>