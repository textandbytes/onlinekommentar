<script setup>
import JetApplicationLogo from '@/Jetstream/ApplicationLogo.vue';
</script>

<template>
    <div>
        <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
            <div class="mt-4 text-2xl">
                Willkommen in der Redaktionsumgebung von Onlinekommentar
            </div>

            <div class="mt-2 text-gray-500">
                Eine gemeinnützige Trägerschaft stellt mit dem Onlinekommentar eine Webplattform zur Verfügung, auf der qualitativ hochwertige und geprüfte Kommentare zum schweizerischen Recht für jedermann frei und kostenlos zur Verfügung gestellt werden können.
            </div>
        </div>

        <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2">
            <div class="p-6">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0H24V24H0z"/><path d="M12 2c5.523 0 10 4.477 10 10 0 4.4-2.841 8.136-6.789 9.473l-.226.074-2.904-7.55C13.15 13.95 14 13.054 14 12c0-1.105-.895-2-2-2s-2 .895-2 2c0 1.077.851 1.955 1.917 1.998l-2.903 7.549-.225-.074C4.84 20.136 2 16.4 2 12 2 6.477 6.477 2 12 2zm0 2c-4.418 0-8 3.582-8 8 0 2.92 1.564 5.475 3.901 6.872l1.48-3.849C8.534 14.29 8 13.207 8 12c0-2.21 1.79-4 4-4s4 1.79 4 4c0 1.207-.535 2.29-1.38 3.023.565 1.474 1.059 2.757 1.479 3.85C18.435 17.475 20 14.92 20 12c0-4.418-3.582-8-8-8z"/></svg>
                    <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">
                        Open Source
                    </div>
                </div>

                <div class="ml-12">
                    <div class="mt-2 text-sm text-ok-gray">
                        Der Source Code für die Publikationsplattform von <em>Onlinekommentar</em> ist auf Github für alle frei verfügbar und kann öffentlich eingesehen, genutzt und geändert werden.
                    </div>

                    <a href="https://github.com/textandbytes/onlinekommentar">
                        <div class="mt-3 flex items-center text-sm font-semibold text-ok-gray">
                            <div>Source Code auf Github anschauen</div>

                            <div class="ml-1 text-ok-gray">
                                <svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="p-6 border-t border-gray-200 md:border-t-0 md:border-l">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 32 32">
                      <path d="M25.297 17.984c-0.204-0.484-0.443-0.948-0.719-1.391v-8.041c0.005-2.265-0.901-4.443-2.511-6.047-1.599-1.609-3.776-2.511-6.047-2.505-2.272-0.005-4.448 0.896-6.052 2.505-1.609 1.599-2.511 3.781-2.505 6.047v1.172h3.427v-1.172c0-1.364 0.531-2.656 1.505-3.625 0.959-0.963 2.265-1.505 3.625-1.5 2.828 0.005 5.124 2.297 5.129 5.125v4.683c-1.557-0.928-3.339-1.417-5.151-1.412-2.677-0.005-5.245 1.057-7.136 2.953-1.895 1.891-2.957 4.459-2.952 7.136-0.005 2.672 1.057 5.239 2.952 7.129 1.891 1.896 4.459 2.964 7.136 2.964s5.245-1.063 7.136-2.959c1.895-1.891 2.957-4.459 2.952-7.135 0-1.36-0.265-2.683-0.791-3.928zM16 28.573c-3.672 0-6.661-2.989-6.661-6.661s2.989-6.661 6.661-6.661c3.672 0 6.661 2.984 6.661 6.661 0 3.672-2.989 6.661-6.661 6.661zM18.86 21.943c0 3.765-5.652 3.765-5.652 0 0-3.771 5.652-3.771 5.652 0z"/>
                    </svg>
                    <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">
                        Open Access
                    </div>
                </div>

                <div class="ml-12">
                    <div class="mt-2 text-sm text-gray-500">
                        Onlinekommentar ist Open Access. Die auf dieser Plattform veröffentlichten Inhalte sind für alle freigegeben und können entgeltfrei gelesen, heruntergeladen, gespeichert, gedruckt und verlinkt werden.
                        
                    </div>

                    <a href="https://open-access.network/informieren/open-access-grundlagen/was-bedeutet-open-access">
                        <div class="mt-3 flex items-center text-sm font-semibold text-ok-gray">
                            <div>Mehr zu Open Access</div>

                            <div class="ml-1 text-ok-gray">
                                <svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="p-6 border-t border-gray-200">
                <div class="flex items-center">
                    <img src="/img/agpl-license.svg" alt="GNU AGPLv3" class="w-12">
                    <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">
                        AGPL License
                    </div>
                </div>

                <div class="ml-12">
                    <div class="mt-2 text-sm text-gray-500">
                        Die <a href="https://www.gnu.org/licenses/agpl-3.0.de.html">GNU Affero General Public License</a> ist eine freie Copyleft-Lizenz für Software, die speziell für die Zusammenarbeit mit der Gemeinschaft im Fall von Netzwerkserver-Software entwickelt wurde.
                        Die meisten Lizenzen für Software sind darauf ausgelegt, die Freiheit zu nehmen, Werke zu teilen und zu verändern. Im Gegensatz dazu soll die AGPL Lizenz die Freiheit garantieren, alle Versionen eines Programms weiterzugeben und zu verändern – damit es für alle Nutzer freie Software bleibt.
                    </div>

                    <a href="https://github.com/textandbytes/onlinekommentar/blob/master/LICENSE.md">
                        <div class="mt-3 flex items-center text-sm font-semibold text-ok-gray">
                            <div>Lizenz anschauen</div>

                            <div class="ml-1 text-ok-gray">
                                <svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="p-6 border-t border-gray-200 md:border-l">
                <div class="flex items-center">
                    <img src="/img/ok-logo.svg" alt="Onlinekommentar" class="w-12" />
                    <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">
                        Verein Onlinekommentar
                    </div>
                </div>

                <div class="ml-12">
                    <div class="mt-2 text-sm text-gray-500">
                        Der <em>Verein Onlinekommentar</em> ist ein gemeinnütziger Verein nach Art. 60 ZGB mit Sitz in Spiegel bei Bern. Mit dem Verein ist eine dauerhafte und stabile Trägerschaft für den Onlinekommentar sichergestellt.
                    </div>

                    <div class="mt-4 text-sm text-gray-500">
                        Die Publikationsplattform <em>Onlinekommentar</em> wurde von der auf Digital Humanities spezialisierten Schweizer Firma <a href="https://textandbytes.com">text &amp; bytes GmbH</a> entwickelt und vom <em>Verein Onlinekommentar</em> finanziert.
                        <a href="https://textandbytes.com"><img class="h-8 mt-2" src="/img/textandbytes-logo.svg" alt="text &amp; bytes"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style lang="postcss" scoped>
    a {
        @apply underline;
    }
</style>