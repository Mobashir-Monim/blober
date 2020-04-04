<script>
    import { Line } from 'vue-chartjs'

    export default {
        extends: Line,
        mounted() {
            this.renderChart(this.chartdata, this.options)
        },
        props:[],
        data() {
            return {
                chartdata: {
                    labels: ['January', 'February'],
                    datasets: [
                        {
                            label: 'Data One',
                            backgroundColor: '#f87979',
                            data: [40]
                        },
                        {
                            label: 'Data Two',
                            backgroundColor: '#f87979',
                            data: [30]
                        },
                        {
                            label: 'Data Three',
                            backgroundColor: '#f87979',
                            data: [100]
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
