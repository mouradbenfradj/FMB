<?php

namespace App\Interfaces;

interface StatistiqueInterface
{
	public function total(?int $parcId): int;
	public function aEau(string $article): array;
	public function vides(): int;
	public function preparees($article): array;
	public function assembleesPreparees($article): array;
	/* 
    {# <div class="row">
						{% set cardBoxes = [
				            {text: 'Total '~conteneur , icon: 'fe-more-vertical',total:total(id,conteneur)},
				            {text: 'Total '~conteneur ~' à l\'eau', icon: 'fe-more-vertical',total:total(id, conteneur,null,true)},
				            {text: conteneur ~'Huîtres<br>à l\'eau', icon: 'fe-more-vertical',total:total(id, conteneur)},
				            {text: conteneur ~'Moules<br>à l\'eau', icon: 'fe-more-vertical',total:total(id, conteneur)},
				            {text: conteneur ~' vides', icon: 'fe-more-vertical',total:total(id, conteneur)},
				            {text: conteneur ~' Préparées', icon: 'fe-more-vertical',total:total(id, conteneur)},
				            {text: conteneur ~' Huîtres<br>Préparées', icon: 'fe-more-vertical',total:total(id, conteneur)},
				            {text: conteneur ~' Moules<br>Préparées', icon: 'fe-more-vertical',total:total(id, conteneur)},
				            {text: conteneur ~' Assemblées<br>Préparées', icon: 'fe-more-vertical',total:total(id, conteneur)},
				            {text: conteneur ~' Assemblées<br>à l\'eau', icon: 'fe-more-vertical',total:total(id, conteneur)},
				            {text: 'Chaussettes '~conteneur ~' à l\'eau', icon: 'fe-more-vertical',total:total(id, conteneur)}
				        ] %}
				      
				        {% for box in cardBoxes %}
				            {% if loop.index == 1 %}
				                {% include "default/partials/_card-box-warning.html.twig" with box only %}
				            {% else %}
				                {% include "default/partials/_card-box-info.html.twig" with box only %}
				            {% endif %}
				        {% endfor %}
					</div> #}
    */
}
