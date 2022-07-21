<template>
    <app-layout>
        <Head>
            <title>{{ meet.name }}</title>
            <meta head-key="description" name="description" :content="meet.name" />
        </Head>

        <template #header>
            <div class="flex flex-wrap justify-between">
                <div class="">
                    <Link class="text-teal-400" :href="route('meets.index')">{{__('Meets')}}</Link>
                    /
                    <Link class="text-teal-400" :href="route('meets.show', meet.slug)">{{ meet.name }}</Link>
                    /
                    <Link class="text-teal-400" :href="route('meets.entries.index', meet.slug)">{{ __('Entries') }}</Link>
                    / {{ __('Statistics') }}
                </div>
            </div>
        </template>

        <div class="max-w-7xl mx-auto py-8 px-0 xl:px-2">
            <div class="bg-white dark:bg-gray-600 shadow p-5 rounded-md">
                <div class="mb-5">
                    <div class="text-xl font-semibold text-teal-500 dark:text-teal-400 mb-2">
                        Leadott nevezések statisztika
                    </div>
                    <div class="flex flex-row text-lg text-black dark:text-white">
                        <div class="flex flex-col">
                            <div>
                                Versenyzők
                            </div>
                            <div>
                                Egyéni nevezések
                            </div>
                            <div>
                                Váltó nevezések
                            </div>
                            <div>
                                Összes nevezés
                            </div>
                        </div>
                        <div class="flex flex-col ml-5">
                            <div>
                                {{ competitors_count }} fő
                            </div>
                            <div>
                                {{ individual_entries_count }} db
                            </div>
                            <div>
                                {{ relay_entries_count }} db
                            </div>
                            <div>
                                {{ individual_entries_count + relay_entries_count }} db
                            </div>
                        </div>
                    </div>
                </div>

                <div v-for="(team, name) in teams" :key="team.id" class="mx-auto my-2">
                    <div class="text-lg font-semibold text-teal-500 dark:text-teal-400 mb-2">
                        {{ name }}
                    </div>
                    <div class="flex flex-row text-black dark:text-white">
                        <div class="flex flex-row">
                            <div class="flex flex-col">
                                <div>
                                    Férfi versenyzők
                                </div>
                                <div>
                                    Női versenyzők
                                </div>
                                <div>
                                    Versenyzők
                                </div>
                            </div>
                            <div class="flex flex-col ml-5">
                                <div>
                                    {{ team.man_count }} fő
                                </div>
                                <div>
                                    {{ team.woman_count }} fő
                                </div>
                                <div>
                                    {{ team.competitors_count }} fő
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-row ml-20">
                            <div class="flex flex-col">
                                <div>
                                    Egyéni nevezések
                                </div>
                                <div>
                                    Váltó nevezések
                                </div>
                                <div>
                                    Összes nevezés
                                </div>
                            </div>
                            <div class="flex flex-col ml-5">
                                <div>
                                    {{ team.individual_entries_count }} db
                                </div>
                                <div>
                                    {{ team.relay_entries_count }} db
                                </div>
                                <div>
                                    {{ team.individual_entries_count + team.relay_entries_count }} db
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-2">
                </div>

                <div v-show="teams.length === 0" class="text-black dark:text-white">
                    {{ __('No teams found') }}
                </div>
            </div>
        </div>
        <ScrollTop />
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout"
import ScrollTop from "@/Shared/ScrollTop"
import JetLabel from "@/Jetstream/Label";
import JetButton from "@/Jetstream/Button";

export default {
    components: {
        AppLayout,
        ScrollTop,
        JetLabel,
        JetButton,
    },
    props: ['meet', 'teams', 'competitors_count', 'individual_entries_count', 'relay_entries_count'],
    setup(props) {

        return {

        }
    },
}
</script>