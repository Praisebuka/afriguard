<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class NmapScanner
{
    /**
     * Run Nmap scan with specified parameters and save output
     *
     * @param string $target IP address, domain name, or IPv6 address
     * @return array
     */
    public function scanTarget($target)
    {
        try {
            // Validate target format (basic validation for IP or domain)
            if (!filter_var($target, FILTER_VALIDATE_IP) && !filter_var($target, FILTER_VALIDATE_URL) && !preg_match('/^[a-zA-Z0-9.-]+$/', $target)) {
                throw new \Exception('Invalid target format');
            }

            // Generate unique filename for report
            $timestamp = now()->format('YmdHis');
            $outputFile = storage_path("app/nmap_scan_{$timestamp}.xml");

            // Build Nmap command with safe escaping
            $command = sprintf(
                'nmap -sV -sC -A -T4 %s -oX %s',
                escapeshellarg($target),
                escapeshellarg($outputFile)
            );

            // Execute Nmap command
            $output = [];
            $returnCode = 0;
            exec($command . ' 2>&1', $output, $returnCode);

            if ($returnCode !== 0) {
                throw new \Exception('Nmap scan failed: ' . implode("\n", $output));
            }

            // Read and parse the XML output
            if (file_exists($outputFile)) {
                $xml = simplexml_load_file($outputFile);
                if ($xml === false) {
                    throw new \Exception('Failed to parse Nmap XML output');
                }

                // Basic parsing of results
                $results = [
                    'target' => $target,
                    'ports' => [],
                    'timestamp' => $timestamp,
                    'report_file' => $outputFile
                ];

                // Parse open ports and services
                if (isset($xml->host->ports->port)) {
                    foreach ($xml->host->ports->port as $port) {
                        $results['ports'][] = [
                            'port' => (string)$port['portid'],
                            'protocol' => (string)$port['protocol'],
                            'state' => (string)$port->state['state'],
                            'service' => (string)$port->service['name'],
                            'product' => (string)$port->service['product'] ?? 'unknown',
                            'version' => (string)$port->service['version'] ?? 'unknown'
                        ];
                    }
                }

                return [ 'status' => 'success', 'data' => $results ];
            }

            throw new \Exception('Nmap output file not found');

        } catch (\Exception $e) {
            Log::error('Nmap scan error: ' . $e->getMessage());
            return [ 'status' => 'error', 'message' => $e->getMessage() ];
        }
    }

}