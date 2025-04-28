<?php
class Article {
    public static function getGeneralNews() {
        return [
            [
                'id' => 1,
                'title' => 'Gobierno anuncia reforma al transporte público en Santiago',
                'category' => 'Nacional',
                'content' => 'El Ministerio de Transportes presentó hoy un ambicioso plan para modernizar el sistema de transporte público en la capital. La iniciativa incluye la renovación de 500 buses, la implementación de 50 nuevos kilómetros de ciclovías y la ampliación del horario de operación del metro hasta la 1:30 AM los fines de semana. Según el ministro, estas medidas buscan reducir los tiempos de viaje en un 25% y disminuir la congestión vehicular en las horas peak. La inversión total superará los $200 mil millones y se implementará gradualmente durante los próximos 18 meses.',
                'image' => 'img/transporte.jpg',
                'excerpt' => 'El plan incluye renovación de buses, nuevas ciclovías y extensión de horarios del metro. La inversión superará los $200 mil millones...'
            ],
            [
                'id' => 2,
                'title' => 'Descubren nueva especie marina en costas chilenas',
                'category' => 'Ciencia',
                'content' => 'Un equipo de investigadores de la Universidad de Concepción descubrió una nueva especie de crustáceo en las profundidades del archipiélago de Juan Fernández. El animal, bautizado provisionalmente como Cancer chilensis, presenta características únicas nunca antes documentadas por la ciencia. Según la Dra. María Fernández, líder de la investigación, este descubrimiento podría aportar importantes datos sobre la evolución de las especies en ecosistemas aislados. El hallazgo se produjo durante una expedición oceanográfica que estudia los efectos del cambio climático en la biodiversidad marina local.',
                'image' => 'img/especie.jpg',
                'excerpt' => 'Científicos identifican crustáceo único en el archipiélago de Juan Fernández que podría revelar datos clave sobre evolución marina...'
            ],
            [
                'id' => 3,
                'title' => 'Festival de Viña 2025 anuncia cartel internacional',
                'category' => 'Espectáculos',
                'content' => 'La organización del Festival de Viña del Mar 2025 reveló hoy el cartel principal del evento, que contará con la participación estelar de Shakira, Manuel Turizo y el grupo Imagine Dragons. Además, se confirmó que por primera vez habrá un escenario alternativo dedicado exclusivamente a bandas emergentes nacionales. El alcalde de Viña del Mar destacó que este año se implementará un nuevo sistema de transporte gratuito desde Valparaíso y se ampliará la capacidad del anfiteatro en un 15%. Las entradas saldrán a la venta el próximo lunes a través del sistema Ticketmaster.',
                'image' => 'img/vina.jpg',
                'excerpt' => 'Shakira, Manuel Turizo e Imagine Dragons encabezan la lista de artistas confirmados para la próxima edición del evento musical...'
            ]
        ];
    }

    public static function getSportsNews() {
        return [
            [
                'id' => 4,
                'title' => 'Chile clasifica al Mundial 2026 tras épica victoria sobre Argentina',
                'category' => 'Fútbol',
                'content' => 'La selección chilena escribió una página gloriosa en su historia al vencer 2-1 a Argentina en el Estadio Monumental, clasificando al Mundial de 2026. Alexis Sánchez abrió el marcador en el minuto 35 con un zurdazo imparable, mientras que Eduardo Vargas selló la victoria en el 78 tras un contraataque letal. El equipo dirigido por Ricardo Gareca mostró una solidez defensiva notable, especialmente en el segundo tiempo cuando Argentina presionó con todo. El arquero Claudio Bravo fue figura con al menos tres atajadas clave. Esta victoria marca el regreso de Chile a una Copa del Mundo después de 12 años de ausencia.',
                'image' => 'img/futbol.jpg',
                'excerpt' => 'La Roja venció 2-1 en Buenos Aires con goles de Alexis Sánchez y Eduardo Vargas, asegurando su participación en el torneo...'
            ],
            [
                'id' => 5,
                'title' => 'Nadal anuncia su retiro profesional tras Roland Garros 2025',
                'category' => 'Tenis',
                'content' => 'El español Rafael Nadal, uno de los más grandes tenistas de la historia, anunció que el próximo Roland Garros será el último torneo de su carrera profesional. He decidido que es el momento adecuado para dar este paso, declaró el 22 veces campeón de Grand Slam en una emotiva rueda de prensa. Nadal, de 39 años, explicó que las lesiones recurrentes y el desgaste físico fueron factores determinantes en su decisión. El torneo parisino, donde ha levantado la copa en 14 ocasiones, será el escenario perfecto para su despedida. La ATP ya anunció que rendirá homenaje al Rey de la Tierra Batida durante todo el evento.',
                'image' => 'img/nadal.jpg',
                'excerpt' => 'El legendario tenista español pondrá fin a su carrera en el torneo donde ha sido más dominante, con 14 títulos...'
            ],
            [
                'id' => 6,
                'title' => 'Selección femenina de Chile hace historia al ganar su primera Copa América',
                'category' => 'Fútbol Femenino',
                'content' => 'La selección chilena femenina de fútbol logró el título más importante de su historia al vencer 1-0 a Brasil en la final de la Copa América 2025. Francisca Lara anotó el gol decisivo en el minuto 78 tras un remate cruzado desde el borde del área. La arquera Christiane Endler fue la gran figura del partido con varias atajadas espectaculares, especialmente en los minutos finales cuando Brasil lanzó todo su arsenal ofensivo. Este triunfo no solo le da a Chile su primer título continental, sino que además clasifica al equipo al Mundial Femenino 2027. Es un sueño hecho realidad para todas nosotras y para el fútbol femenino chileno, declaró emocionada la capitán Carla Guerrero durante la celebración.',
                'image' => 'img/futbol-femenino.jpg',
                'excerpt' => 'Triunfo 1-0 sobre Brasil con gol de Francisca Lara y gran actuación de Christiane Endler bajo los tres palos...'
            ]
        ];
    }

    public static function getBusinessNews() {
        return [
            [
                'id' => 7,
                'title' => 'Bitcoin alcanza récord histórico superando los $100,000',
                'category' => 'Mercados',
                'content' => 'La criptomoneda líder rompió todas las barreras psicológicas al superar por primera vez los $100,000 durante la sesión de hoy. Este hito llega tras la aprobación de varios ETFs institucionales en Estados Unidos y el anuncio de que grandes fondos de inversión están asignando entre un 3% y 5% de sus carteras a activos digitales. Analistas de JPMorgan señalan que este rally podría continuar hasta los $120,000 antes de una posible corrección técnica. El mercado está respondiendo a la escasez programada de Bitcoin y a su adopción como reserva de valor por parte de empresas y países, explicó María González, estratega senior de CryptoMarkets. Sin embargo, algunos expertos advierten sobre la volatilidad inherente a estos activos.',
                'image' => 'img/bitcoin.jpg',
                'excerpt' => 'La criptomoneda líder rompe barreras psicológicas impulsada por adopción institucional y escasez programada...'
            ],
            [
                'id' => 8,
                'title' => 'Chile y Corea del Sur firman histórico Tratado de Libre Comercio',
                'category' => 'Comercio',
                'content' => 'En una ceremonia celebrada en Seúl, los presidentes de Chile y Corea del Sur firmaron hoy un amplio Tratado de Libre Comercio que eliminará aranceles para el 92% de los productos chilenos. El acuerdo beneficiará especialmente a los exportadores de salmón, frutas frescas, vinos y productos mineros. Según estimaciones del Ministerio de Economía, este TLC podría aumentar el comercio bilateral en un 15% para 2026, generando unos 5,000 nuevos empleos en el sector exportador. Este es el acuerdo comercial más importante que hemos firmado en la última década, destacó el ministro de Hacienda. Corea del Sur se convierte así en el primer país asiático con el que Chile tiene un TLC de segunda generación, que incluye capítulos sobre comercio digital y desarrollo sostenible.',
                'image' => 'img/tlc.jpg',
                'excerpt' => 'Acuerdo eliminará aranceles para el 92% de los productos chilenos y podría generar 5,000 nuevos empleos en el sector exportador...'
            ],
            [
                'id' => 9,
                'title' => 'Codelco reporta producción récord y utilidades por US$2,100 millones',
                'category' => 'Minería',
                'content' => 'La Corporación Nacional del Cobre (Codelco) anunció hoy sus resultados del primer semestre de 2025, destacando un aumento del 7% en su producción (450,000 toneladas métricas) y utilidades por US$2,100 millones, las más altas en una década. Este desempeño se explica por los altos precios del cobre (promedio de US$4.25 la libra) y las mejoras de productividad implementadas en sus divisiones. El presidente ejecutivo destacó que Chuquicamata Subterránea alcanzó por primera vez su capacidad de diseño, mientras que El Teniente superó sus metas de eficiencia. Estos resultados nos permitirán reinvertir en nuestros proyectos estructurales y seguir contribuyendo al Fisco, señaló. Sin embargo, la empresa advirtió sobre los desafíos que plantea la menor ley del mineral en sus yacimientos más antiguos.',
                'image' => 'img/codelco.jpg',
                'excerpt' => 'La estatal aumentó su producción en un 7% gracias a mejores precios del cobre y mayor eficiencia operacional...'
            ]
        ];
    }
}
?>