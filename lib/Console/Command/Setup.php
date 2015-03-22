<?php
/*
 * This file is part of mesamatrix.
 *
 * Copyright (C) 2014 Romain "Creak" Failliot.
 * Copyright (C) 2014 Robin McCorkell <rmccorkell@karoshi.org.uk>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace Mesamatrix\Console\Command;

use \Symfony\Component\Console\Input\InputInterface;
use \Symfony\Component\Console\Output\OutputInterface;

class Setup extends \Symfony\Component\Console\Command\Command
{
    protected function configure()
    {
        $this->setName('setup')
             ->setDescription('Initialise Mesamatrix')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $git = new \Mesamatrix\Git\ProcessBuilder(array(
          'clone', '--bare', '--depth', \Mesamatrix::$config->getValue('git', 'depth', 6000),
          \Mesamatrix::$config->getValue('git', 'mesa_url'), '@gitDir@'
        ));
        $this->getHelper('process')->mustRun($output, $git->getProcess());
    }
}
