<script>
    import { Bar } from 'vue-chartjs'

    export default {
        extends: Bar,
        mounted() {
            this.chartdata.labels = JSON.parse(this.labelsset);
            this.chartdata.datasets[0].data = JSON.parse(this.pointsset);
            this.chartdata.datasets[1].data = JSON.parse(this.errorsset);
            this.chartdata.datasets[2].data = JSON.parse(this.trialsset);
            this.chartdata.datasets[3].data = JSON.parse(this.queriesset);
            
            console.log(this.chartdata);

            this.renderChart(this.chartdata, this.options)
        },
        props:['pointsset', 'labelsset', 'errorsset', 'trialsset', 'queriesset'],
        data() {
            return {
                chartdata: {
                    labels: [],
                    datasets: [
                        {
                            label: 'Points Change',
                            backgroundColor: '#6EB3FF',
                            data: []
                        },
                        {
                            label: 'Trial Errors',
                            backgroundColor: '#f87979',
                            data: []
                        },
                        {
                            label: 'Trials Count',
                            backgroundColor: '#64E8C3',
                            data: []
                        },
                        {
                            label: 'Queries Atttempted',
                            backgroundColor: '#4E89CC',
                            data: []
                        },
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            }
        },
        methods: {

        },
        computed: {

        }
    }
</script>
