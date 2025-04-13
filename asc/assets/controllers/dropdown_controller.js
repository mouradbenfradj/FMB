import { Application } from '@hotwired/stimulus'
import Dropdown from '@stimulus-components/dropdown'

const application = Application.start()
application.register('dropdown', Dropdown)